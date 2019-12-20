<?php
//生成手机号
use Swoole\Coroutine\System;
const REDIS_SERVER_HOST = '127.0.0.1';
const REDIS_SERVER_PORT = 6379;

$sprint = "130*****106";


go(function () use ($sprint) {
    $redis = new Swoole\Coroutine\Redis();
    $redis->connect(REDIS_SERVER_HOST, REDIS_SERVER_PORT);


    for($i = 0;$i <= 99999;$i++){

        $mid = str_pad($i,5,0,STR_PAD_LEFT );
        $mobile = str_replace("*****",$mid,$sprint);
        $key = "m:$mid";

        $redis->setDefer();
        $redis->set($key, $mobile);
        $res = $redis->recv();
        if($res){
            echo "$mobile:生成成功,key:{$key}\n";
        }else{
            echo "$mobile:生成失败!!\n";
        }
    }
    echo "创建手机号完毕\n";
});
