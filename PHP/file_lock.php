<?php


    //文件锁
    $fp = fopen("lock.txt", "w+");
    // 通过文件锁住操作执行完再执行下一个
    if (!flock($fp, LOCK_EX | LOCK_NB)) {
        echo "系统繁忙，请稍后再试";
        return;
    }

    echo 111;
    flock($fp, LOCK_UN);//释放锁


    //关闭文件
    fclose($fp);