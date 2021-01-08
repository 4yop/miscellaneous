<?php

    use swoole\Process;



    set_time_limit(0);



    $key = "lock:test";
    $ttl = 10000;


    //cli_set_process_title('php-lock');
    require_once  'RedLock.php';
    $servers = [
        ['127.0.0.1', 6379, 0.01],
        //['127.0.0.1', 6378, 0.01],
    ];


    $redLock = new RedLock($servers);



    $lock = $redLock->lock($key, $ttl);
    if ($lock) {
        print_r($lock);
    } else {
        print "Lock not acquired\n";exit;
    }
    sleep(15);

    $redLock->unlock($lock);

    //$watch->wait();
    echo 'hi,解锁了'."\n";
