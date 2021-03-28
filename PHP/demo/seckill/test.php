<?php
    //阻塞模式
    $fp = fopen('lock.txt','w+');
    if(flock($fp,LOCK_EX)){
        //订单正在处理中..
        flock($fp,LOCK_UN);
    }
    fclose($fp);

    //非阻塞模式
    $fp = fopen("locck.txt",'w+');
    if(flock($fp,LOCK_EX | LOCK_NB)){
        flock(LOCK_UN);
    }else{
        echo "系统繁忙";
    }
    fclose($fp);
