<?php
    //并发
    //库存超卖

    //文件锁
    $lockFile = 'lock.lock';
    if(file_exists($lockFile)){
        if($_SERVER['REQUEST_TIME'] - filemtime($lockFile) > 600){
            @unlink($lockFile);
        }
    }

    touch($lockFile);

    chmod($lockFile,0777);

    //redis