<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $team_id = $request->input("team_id","");

        $where = [];
        if ($team_id > 0)
        {
            $where[] = ['user_path','LIKE',",{$team_id},%"];
        }

        $members = Member::query()
                        ->where($where)
                        ->with(['first_user','second_user','third_user'])
                        ->orderBy('depth','ASC')
                        ->orderBy('user_path','ASC')
                        ->paginate();
        return view("member.index",[
            "members" =>$members,
            "team_id" => $team_id,
        ]);
    }

    public function changeTeam(Request $request)
    {
        $member_id = $request->input("member_id",0);
        $parent_id = $request->input("parent_id",0);

        $member = Member::query()->where("member_id","=",$member_id)->first();
        $parent = Member::query()->where("member_id","=",$parent_id)->first();

        $parent_user_path_arr = array_filter(explode(",",$parent["user_path"]));
        $member_user_path_arr = array_filter(explode(",",$member["user_path"]));
        if(in_array($parent_id,$member_user_path_arr))
        {
            return response()->json(['msg'=>"[{$parent_id}]是[{$member_id}]下级，不可这样转"]);
        }
        //member_id 团队depth改 为父的+1
        //member_id 团队 user_path 改 ，拼接
        //member_id 团队三个分销上级改 找

        $members = Member::query()
                            ->where(['user_path','LIKE',",{$member_id},%"])
                            ->orderBy("depth",'ASC')
                            ->get();

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


        foreach ($members as $m)
        {
            $new_path = $get_user_path_str($m["user_path"]);



            $data = [
                'depth'     =>  $member["depth"] - $m["depth"] + $parent["depth"],
                'user_path' => $new_path,
                'first_userid'  => $m['commiss_level'] >= 1 ? $m['member_id'] : 0,
                'second_userid' => $m['commiss_level'] >= 2 ? $m['member_id'] : 0,
                'third_userid'  => $m['commiss_level'] >= 3 ? $m['member_id'] : 0,
            ];

            $first_userid = $second_userid = $third_userid = 0;

            $m1 = $get_member_by_level(1,$new_path,$data["depth"]);

            $m2 = $get_member_by_level(2,$new_path,$data["depth"]);

            $m3 = $get_member_by_level(3,$new_path,$data["depth"]);

            if (!$m3->isEmpty())
            {
                $third_userid = $m3['member_id'];
                $second_userid = $m3['member_id'];
                $first_userid = $m3['member_id'];
            }
            if (!$m2->isEmpty()
                &&
                ($m3['depth']->isEmpty() || $m3['depth'] > $m2["depth"] )
            )
            {
                $second_userid = $m2['member_id'];
                $first_userid = $m2['member_id'];
            }
            if (!$m1->isEmpty()
                && (
                ($m3['depth']->isEmpty() || $m3['depth'] > $m1["depth"] )
                &&
                ($m2['depth']->isEmpty() || $m2['depth'] > $m1["depth"] )
                ) )
            {
                $first_userid = $m1['member_id'];
            }

            $data['first_userid'] = $data['first_userid'] == 0 ? $first_userid : $data['first_userid'];
            $data['second_userid'] = $data['second_userid'] == 0 ? $second_userid : $data['second_userid'];
            $data['third_userid'] = $data['third_userid'] == 0 ? $third_userid : $data['third_userid'];




            Member::query()
                    ->where(['member_id','=',$m['member_id']])
                    ->update($data);




        }



    }

}
