<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/12
 * Time: 10:23
 */
//进程

$process = new swoole_process('callback',true);


function callback(swoole_process $process){
    $php = "/www/server/php/73/bin/php";

    $file = [
        __DIR__."/web_socket_server.php",
        __DIR__."/http_server.php",

    ];
    //执行多个文件  php xxx.php
    $process->exec($php,$file);
}

# ps -aux | grep process.php
#pstree p {pid}

//启动进程
$pid = $process->start();
//echo $process->read();//读取内容
print_r(compact('pid'));
print_r($process);