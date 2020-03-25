<?php


$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis_name = 'miaosha';
$sales='goods_store';
//
$uid = mt_rand(1000,9999);
$store = 10;
usleep(100000);// usleep()函数的功能是把调用该函数的线程挂起一段时间 [1]  ， 单位是微秒（microseconds：即百万分之一秒）
if ($store > $redis->get($sales)) {
    $redis->incr($sales);
    $redis->lpush($redis_name, $uid);//
    // echo $uid."秒杀成功|";
} else {
    // echo "秒杀已结束";
}

$redis->close();

