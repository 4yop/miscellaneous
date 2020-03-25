<?php



header("content-type:text/html;charset=utf-8");

$dsn='mysql:host=localhost;dbname=test';
try {
    $conn= new PDO($dsn, 'root', 'root');
    $conn->exec("set names utf8");

} catch (PDOException $e) {
    exit('数据库连接失败，错误信息：'. $e->getMessage());
}

$price    = 10;
$user_id  = 1;
$goods_id = 1;
$sku_id   = 11;
$number   = 1;

//生成唯一订单
function build_order_no(){
    return date('ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}

$redis  = new Redis();
$result = $redis->connect('127.0.0.1',6379);
//通过死循环从队列中一直取值
while (true) {
    //模拟下单操作
    //下单前判断redis队列库存量
    $userid  = $redis->rpop('miaosha');

    if(!$userid){
        // insertLog('error:no store redis');
        continue;
    }
    //生成订单
    $order_sn = build_order_no();
    $sql="insert into ih_order(order_sn,user_id,goods_id,sku_id,price)
    values('$order_sn','$userid','$goods_id','$sku_id','$price')";
    $conn->query($sql);

    //库存减少
    $sql="update ih_store set number=number-{$number} where sku_id='$sku_id'";
    $f = $conn->query($sql);
    if ($f) {
        // insertLog('库存减少成功');
    }else{
        // insertLog('库存减少失败');
    }
}
$redis->close();