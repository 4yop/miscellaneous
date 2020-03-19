<?php
    header("content-type:text/html;charset=utf-8");

    $dsn = "mysql:host=localhost;dbname=test";
    try{
        $conn = new PDO($dsn,'root','root');
        $conn->exec("set names utf8");
    }catch (PDOException $e){
        exit("数据库连接失败,{$e->getMessage()}");
    }

//    if(empty($_GET['user_id']) || !isset($_GET['user_id'])){
//        echo "请登录";exit;
//    }
//    $user_id  = intval($_GET['user_id']);
    $user_id = 1;


    $goods_id = 1;
    $sku_id   = 2;
    $number   = 1;

    //生成唯一订单号
    function bulid_order_no(){
        return date('ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    $sql="SELECT `number`,`goods_name`,`price` FROM `ih_store` WHERE `goods_id`={$goods_id} AND `sku_id`= {$sku_id} AND `number` > 0";

    $rs = $conn->query($sql);
    $row = $rs->fetch();

    //文件锁
    $fp = fopen("lock.txt", "w+");
    // 通过文件锁住操作执行完再执行下一个
    if (!flock($fp, LOCK_EX | LOCK_NB)) {
        echo "系统繁忙，请稍后再试";
        return;
    }

    if($row['number'] > 0){//库存数量
        $order_sn = bulid_order_no();
        $sql="INSERT INTO `ih_order`(`order_sn`,`user_id`,`goods_id`,`sku_id`,`price`,`create_time`)
    values('{$order_sn}','{$user_id}','{$goods_id}','{$sku_id}','{$row['price']}',{$_SERVER['REQUEST_TIME']})";
        $conn->query($sql);

        //库存减少
        $sql="UPDATE `ih_store` SET `number`=`number`-{$number} WHERE `sku_id` = '{$sku_id}'";
        $f = $conn->query($sql);
        if($f){
            //减少成功
            echo "user:{$user_id},{$row['goods_name']}下单成功<br>\n";
            flock($fp, LOCK_UN);//释放锁
        }else{
            //库存不够
            echo "{$row['goods_name']}没有库存了<br>\n";
        }
    }else{
        echo "{$row['goods_name']}没有库存了<br>\n";
    }
    fclose($fp);
    echo "执行完成";