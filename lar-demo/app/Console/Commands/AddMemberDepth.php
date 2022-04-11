<?php

namespace App\Console\Commands;

use App\Models\Member;
use Illuminate\Console\Command;

class AddMemberDepth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'member:depth';

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
        $last_member_id = 0;

        while (true)
        {
            $members = Member::query()
                ->where('member_id',">",$last_member_id)
                ->orderBy("member_id",'asc')
                ->limit(100)
                ->get();
            if ($members->isEmpty())
            {
                break;
            }
            foreach ($members as $member)
            {
                $user_path_arr = explode(",",$member["user_path"]);

                $user_path_arr = array_filter($user_path_arr);
                $res = Member::query()
                        ->where("member_id","=",$member["member_id"])
                        ->update(['depth'=>count($user_path_arr)]);
                $last_member_id = $member["member_id"];
                $this->getOutput()->writeln([
                    $member["member_id"].":".count($user_path_arr),
                ]);
            }
        }


        return 0;
    }




}
