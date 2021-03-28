<?php

    require_once 'db.php';
    $goods_id = 1;
    $sql = "SELECT * FROM `product` WHERE `id` = {$goods_id}";

    $rs = $conn->query($sql);
    $goods= $rs->fetch();

    //是否有库存
    if(empty($goods) || $goods['store'] < 1){
        echo "[{$goods_id}][{$goods['name']}]没有库存了";
        exit;
    }

    //记录日志
    //加积分
    //生成订单
    //付款
    sleep(1);//程序休眠，模拟真实环境

    //echo "[{$goods_id}][{$goods['name']}]有库存";
    //减库存
    $sql = "UPDATE `product` SET `store` = `store` - 1 WHERE `product`.`id` = {$goods_id}";
    $res = $conn->exec($sql);

    if($res){
        echo "[{$goods_id}][{$goods['name']}]购买成功";
    }else{
        echo "[{$goods_id}][{$goods['name']}]购买失败";
    }

    //apache 模拟多个用户购买商品

    // ab -c 并发数(同时访问人数) -n 请求数 http://tw.com/buy.php(请求地址)

    //ab -c 300 -n 600 http://tw.com/buy.php

