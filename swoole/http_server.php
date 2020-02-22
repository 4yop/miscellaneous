<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/9
 * Time: 14:56
 */

$host = '0.0.0.0';
$port = 9501;
$httpServer = new swoole_http_server($host,$port);


//配置
$httpServer->set(
    [
        'enable_static_handler' => true,//开启静态文件请求处理功能
        'document_root' => __DIR__.'/data',//路径
    ]
);

//监听request事件
$httpServer->on('request',function($request,$response){

    //$header = $request->header;
    print_r([
        '标题' => '监听request事件',
        'request数据' => $request
    ]);
    $sendClienMsg = "你访问了我";
    $response->header("Content-Type", "text/html; charset=utf-8");

    $response->end($sendClienMsg);
});

$httpServer->start();