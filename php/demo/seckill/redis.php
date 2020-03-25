<?php
    header("Content-Type: text/html;charset=utf-8");
    //1.mysql 速度问题，redis
    //2.redis监控
    try{
        $redis = new Redis();
        $redis->connect('127.0.0.1',6379);
    }catch (RedisException $e){
        exit("redis连接失败,{$e->getMessage()}");
    }

    //$redis->auth();
    //监视销售量
    $redis->watch('count');
    //销售量
    $redis->set('count',10);
    $count = $redis->get('count');

    $num = 2;//库存

    if($count >= $num){
        exit('活动结束');
    }

    $redis->multi();//将命令放入队列，不执行

    $redis->incrBy('count',1);//销量加


    sleep(1);//模拟业务通知

    $res = $redis->exec();

    //$redis->hset();//存在集合 ，慢慢入库
//    if($res){
//        require_once 'db.php';
//        $sql = "UPDATE `product` SET `store` = `store` - 1 WHERE `product`.`id` = {$goods_id}";
//        $res = $conn->exec($sql);
//    }
    exit;