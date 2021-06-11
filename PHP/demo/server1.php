<?php


    $s = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
    socket_bind($s,"0.0.0.0",1234);
    socket_listen($s);

    while ( ($r = socket_accept($s)) != false)
    {
        socket_getpeername($r,$addr);
        echo "{$addr} connected \n";
        while (true)
        {
            if (!socket_recv($r,$data,1024,MSG_DONTWAIT))
            {
                break;
            }
            echo "{$data}\n";
            socket_write($r,$data);
        }
    }
    socket_close($s);