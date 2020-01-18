<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/6
 * Time: 9:54
 */

//构建server对象
$serv = new Swoole\Server('0.0.0.0',9501,SWOOLE_BASE,SWOOLE_SOCK_TCP);

//设置运行时参数
$serv->set([
    'worker_num' => 4,//进程数
    'max_request' => 1000,//最大请求数
    //'demonize' => true,
    //'backlog' => 128,
]);

//注册事件回调函数

/**连接事件
 * @param swoole_server $server swoole\Server对象
 * @param $fd int 连接文件
 * @param $reactorId  哪个线程
 */
$serv->on('connect',function ($server,$fd,$reactorId){

    print_r([
        '标题' => '执行on connect',
        '连接文件fd'=>$fd,
        '线程id reactorId'=>$reactorId,
        //'server' => $server,
    ]);

});
/**接收到数据时回调此函数
 * @param swoole_server $server server对象
 * @param $fd int TCP客户端连接的唯一标识符
 * @param $reactor_id TCP连接所在的Reactor线程ID
 * @param $data string 收到的数据内容，可能是文本或者二进制内容
 */

$serv->on('receive',function ($server,$fd,$reactor_id,$data){

    print_r([
        '标题' => '执行on receive',
        '连接文件fd'=>$fd,
        'Reactor线程ID'=>$reactor_id,
        '收到数据'=>$data,
        //'server' => $server,
    ]);

    $clients = [];
    foreach ($server->connections as $k=>$v){
        $clients[$k] = $v;
    }

    print_r(
        [
            '进程pid' => $server->manager_pid,
            '主进程pid' => $server->master_pid,
            '所有的客户端连接' => $clients,
        ]
    //$serv->manager_pid;//进程pid
//$serv->master_pid;//主进程pid
//$serv->connections;//所有的客户端连接
    );
    $str = "\n(fd:{$fd})[".date('Y-m-d:H:i:s',$_SERVER['REQUEST_TIME'])."]你说:{$data}
    \n[".date('Y-m-d:H:i:s',$_SERVER['REQUEST_TIME'])."]服务器回复:{$data}\n";
    $server->send($fd,$str);
});

/**TCP客户端连接关闭后
 * @param swoole_server $server server对象
 * @param $fd 连接的文件描述符
 * @param $reactorId 来自那个reactor线程，主动close关闭时为负数
 */

$serv->on('close',function ($server,$fd,$reactorId){

    print_r([
        '标题' => '执行on close',
        '连接文件'=>$fd,
        'Reactor线程ID'=>$reactorId,
        //'server' => $server,
    ]);

});

$serv->start();








//启动服务器
//$serv->manager_pid;//进程pid
//$serv->master_pid;//主进程pid
//$serv->connections;//所有的客户端连接