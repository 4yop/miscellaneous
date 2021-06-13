<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    //创建 socket
    $s = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);

    //绑定端口
    socket_bind($s,"0.0.0.0",1234);


    socket_listen($s);

    define('WEB_ROOT',__DIR__."/root/");


    while ( ($r = socket_accept($s)) != false)
    {
        socket_getpeername($r,$addr);
        echo "{$addr} connected \n";

        //读取请求内容
        $request = socket_read($r, 9024);
        if (!$request)
        {
            continue;
        }


        try
        {
            var_dump($request);
            $headers = explode("\r\n",$request);
            //获取请求的文件
            $file = html_entity_decode(explode(' ',$headers[0])[1]);

            if ($file == "/")
            {
                $file = "/index.html";
            }
            if (!file_exists(WEB_ROOT.$file))
            {
                $file = "/404.html";
            }

            $content = file_get_contents(WEB_ROOT.$file);
            $response = "HTTP/1.0 200 OK \r\n\r\n".$content;
        }catch (Throwable $e)
        {
            $response = "HTTP/1.0 404 NOT FOUND \r\n\r\n".$e->getMessage();
        }

        //发送消息
        socket_write($r,$response);

        socket_close($r);


    }
    socket_close($s);