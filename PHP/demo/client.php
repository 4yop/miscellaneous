<?php

    $s = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
    socket_connect($s,"127.0.0.1",1234);

    //发
    for($i = 0;$i < 10;$i++)
    {
        socket_write($s,"{$i}{$i}\n");
    }
    socket_recv($s,$data,1024,0);
    var_dump($data);


//    use Swoole\Coroutine;
//    use function Swoole\Coroutine\run;
//
//
//    run(function () {
//        $socket = new Coroutine\Socket(AF_INET, SOCK_STREAM, 0);
//
//        $retval = $socket->connect('127.0.0.1', 1234);
//        while ($retval)
//        {
//            $n = $socket->send('hello');
//            var_dump($n);
//
//            $data = $socket->recv();
//            var_dump($data);
//
//            //发生错误或对端关闭连接，本端也需要关闭
//            if ($data === '' || $data === false) {
//                echo "errCode: {$socket->errCode}\n";
//                $socket->close();
//                break;
//            }
//
//            Coroutine::sleep(1.0);
//        }
//
//        var_dump($retval, $socket->errCode, $socket->errMsg);
//    });