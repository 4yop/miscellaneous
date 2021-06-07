<?php
    require_once "helper.php";
error_reporting(E_ALL);
ini_set("display_errors", "On");

    $redis = redis();

    $user = [
        'id' => 1,
        'name' => '小明',
        'sex'  => '男',
    ];

   $res=  $redis->setex("user:{$user['id']}",100,json_encode($user));


   var_dump($res);

   $user_json = $redis->get("user:{$user['id']}");

   var_dump(json_decode($user_json,true));


   $r = $redis->hMSet("user:{$user['id']}:h",$user);

   var_dump($r);

    $user_h = $redis->hGetAll("user:{$user['id']}:h");

   var_dump($user_h);