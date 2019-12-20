<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/8
 * Time: 11:33
 */
//UDP 服务
    //创建udp服务
    $host = '127.0.0.1';
    $port = 9502;
    $mode = SWOOLE_PROCESS;//多线程模式
    $sock_type = SWOOLE_SOCK_UDP;//UDP类型
    $server = new swoole_server($host,$port,$mode,$sock_type);

    $server->on('packet',function($server,$data,$clientInfo){
        print_r(
            [
                '标题' => "监听packet事件",
                '数据data' => $data,
                '客户端信息' => $clientInfo,
            ]
        );
        $address = $clientInfo['address'];
        $port = $clientInfo['port'];
        $pack = "服务器:你发了 {$data}";
        $server->sendto($address,$port,$pack);
    });

    $server->start();