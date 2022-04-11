<?php

namespace App\Console\Commands;

use App\Models\Member;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangeTeam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:team {member_id} {parent_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $member_id = $this->argument('member_id');
        $parent_id = $this->argument('parent_id');

        $member = Member::query()->where("member_id","=",$member_id)->first();
        $parent = Member::query()->where("member_id","=",$parent_id)->first();

        $parent_user_path_arr = array_filter(explode(",",$parent["user_path"]));
        $member_user_path_arr = array_filter(explode(",",$member["user_path"]));
        if(in_array($parent_id,$member_user_path_arr))
        {
            $this->getOutput()->writeln("[{$parent_id}]是[{$member_id}]下级，不可这样转");
            return 0;
        }
        //member_id 团队depth改 为父的+1
        //member_id 团队 user_path 改 ，拼接
        //member_id 团队三个分销上级改 找

        $members = Member::query()
            ->where('user_path','LIKE',",{$member_id},%")
            ->orderBy("depth",'ASC')
            ->get();
        $count = $members->count();
        $this->getOutput()->writeln("{$count}用户受影响");


        $get_user_path_str = function ($user_path) use ($parent_user_path_arr,$member) {

            $path = $parent_user_path_arr;

            $path[] = $member['member_id'];

            $user_path_arr = array_filter(explode(",",$user_path));

            $is_find = false;
            foreach ($user_path_arr as $m_id)
            {
                if ($is_find == true)
                {
                    $path [] = $m_id;
                }elseif ($m_id == $member['member_id'])
                {
                    $is_find = true;
                }
            }
            $path_str = implode(",",$path);
            return ",{$path_str},";
        };

        $get_member_by_level = function ($level,$new_path,$depth) {
            return Member::query()
                ->where(
                    [
                        ["member_id","IN",array_filter(explode(",",$new_path))],
                        ["commiss_level","=",$level],
                        ["depth","<",$depth]
                    ]
                )
                ->orderBy('depth','desc')
                ->first();
        };
        try {
            DB::beginTransaction();
            foreach ($members as $m) {
                $new_path = $get_user_path_str($m["user_path"]);


                $data = [
                    'depth' =>  $m["depth"] - $member["depth"] + $parent["depth"],
                    'user_path' => $new_path,
                    'first_userid' => $m['commiss_level'] >= 1 ? $m['member_id'] : 0,
                    'second_userid' => $m['commiss_level'] >= 2 ? $m['member_id'] : 0,
                    'third_userid' => $m['commiss_level'] >= 3 ? $m['member_id'] : 0,
                ];

                $first_userid = $second_userid = $third_userid = 0;

                $m1 = $get_member_by_level(1, $new_path, $data["depth"]);

                $m2 = $get_member_by_level(2, $new_path, $data["depth"]);

                $m3 = $get_member_by_level(3, $new_path, $data["depth"]);

                if ($m3) {
                    $third_userid = $m3['member_id'];
                    $second_userid = $m3['member_id'];
                    $first_userid = $m3['member_id'];
                }
                if ($m2
                    &&
                    (!$m3 || $m3['depth'] > $m2["depth"])
                ) {
                    $second_userid = $m2['member_id'];
                    $first_userid = $m2['member_id'];
                }
                if ($m1
                    && (
                        (!$m3 || $m3['depth'] > $m1["depth"])
                        &&
                        (!$m2 || $m2['depth'] > $m1["depth"])
                    )) {
                    $first_userid = $m1['member_id'];
                }

                $data['first_userid'] = $data['first_userid'] == 0 ? $first_userid : $data['first_userid'];
                $data['second_userid'] = $data['second_userid'] == 0 ? $second_userid : $data['second_userid'];
                $data['third_userid'] = $data['third_userid'] == 0 ? $third_userid : $data['third_userid'];

                $this->getOutput()->writeln("id:" . $m['member_id']);
                dump($data);

                Member::query()
                    ->where('member_id', '=', $m['member_id'])
                    ->update($data);


            }
            DB::commit();

        }catch (\Exception $e)
        {
            DB::rollBack();
            $this->getOutput()->writeln($e->getMessage());
            return 0;
        }
        echo "成功\n";
        return 0;
    }




}
