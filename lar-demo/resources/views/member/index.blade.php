<style>
    td
    {
        border: 1px solid #000000;
        padding: 0 5px;
    }
    .w-5{
        width: 5px;
    }
    .h-5
    {
        height: 5px;
    }
    a{
        text-decoration: underline;
        color: blue;
    }
</style>
<?php
    $level_name = [
        0 => "普通人",
        1 => "等级1",
        2 => "等级2",
        3 => "等级3",
    ];
?>
<form method="get">
    <input placeholder="输入团队id" value="<?=$team_id?>" name="team_id" type="number">
    <button>查找</button>
</form>

<form method="post">
     将
    <input placeholder="id" value="<?=$team_id?>" name="team_id" type="number">
    转到
    <input placeholder="id" value="<?=$team_id?>" name="team_id" type="number">
    下级

    <button>确定</button>
    <button>查询影响</button>
</form>

<table>
    <tr>
        <td>ID</td>
        <td>昵称</td>
        <td>头像</td>
        <td>深度</td>
        <td>等级</td>
        <td>3个分销上级</td>
        <td>操作</td>
        <td>用户上级关系</td>
    </tr>
    <?php
    foreach ($members as $member)
    {
    ?>
        <tr>
            <td><?=$member["member_id"]?></td>
            <td><?=$member["username"]?></td>
            <td><img width="50" height="50" src="<?=$member["avatar"]?>"></td>
            <td><?=$member["depth"]?></td>
            <td><?=$level_name[$member["commiss_level"]]?></td>
            <td>
{{--                <?=$member["first_userid"]?><br>--}}

{{--                <?=$member["second_userid"]?><br>--}}

{{--                <?=$member["third_userid"]?><br>--}}

                <?php if($member["first_user"]){?>
                [<?=$member["first_user"]["member_id"]?>]
                [<?=$level_name[$member["first_user"]["commiss_level"]]?>]
                [<?=$member["first_user"]["username"]?>]
                <img width="50" height="50" src="<?=$member["first_user"]["avatar"]?>">
                <?php }?>
                <br>
                <?php if($member["second_user"]){?>
                [<?=$member["second_user"]["member_id"]?>]
                [<?=$level_name[$member["second_user"]["commiss_level"]]?>]
                [<?=$member["second_user"]["username"]?>]
                <img width="50" height="50" src="<?=$member["second_user"]["avatar"]?>">
                <?php }?>
                <br>
                <?php if($member["third_user"]){?>
                [<?=$member["third_user"]["member_id"]?>]
                [<?=$level_name[$member["third_user"]["commiss_level"]]?>]
                [<?=$member["third_user"]["username"]?>]
                <img width="50" height="50" src="<?=$member["third_user"]["avatar"]?>">
                <?php }?>
            </td>
            <td>
                <a>转下级</a>
            </td>
            <td><?=$member["user_path"]?></td>
        </tr>
    <?php

    }
    ?>





</table>


<?=$members->appends(["team_id"=>$team_id])->links();?>
