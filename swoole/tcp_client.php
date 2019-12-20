<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/8
 * Time: 11:10
 */

//创建客户端对象
$client = new swoole_client(SWOOLE_SOCK_TCP);
//连接到服务器
$host = '127.0.0.1';
$port = 9501;
$timeout = 0.5;
if(!$client->connect($host,$port,$timeout)){
    die('客户端连接服务器失败');
}

fwrite(STDOUT,"请输入消息:");
$msg = trim(fgetc(STDIN));
//向服务器发数据
//$msg = "我发东西给你";
if(!$client->send($msg)){
    die("向服务器发数据失败:{$msg}");
}

//接收服务器数据
$data = $client->recv();
if(!$data){
    die("接收服务器数据失败或没有:{$data}");
}

echo "服务器说:{$data}";

//说完就关？？
$client->close();