<?php

    //写执行队列的程序
    require_once "Queue.class.php";


    if(strpos(strtolower(PHP_OS),'win') !== false)
    {
        $os = 'window';
    }
    else
    {
        $os = 'linux';
    }

    if($os == 'window')
    {
        $phpcmd = "D:\phpstudy_pro\Extensions\php\php7.3.4nts\php.exe";
    }
    else
    {
        $phpcmd = exec("which php");
    }


    $queue = new Queue($conn);

    $tasks = $queue->getQueueTask(200);
    
    foreach ($tasks as $k => $v)
    {
        print_r($v);
        $taskphp = $v['taskphp'];
        $param = $v['param'];
        $obj = $phpcmd." ".escapeshellarg($taskphp) . " " . escapeshellarg($param);
        system($obj);
        exit;
    }