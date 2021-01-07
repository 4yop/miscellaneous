<?php

    use Swoole\Process;


    //文件名称，监控的进程id,key,锁的过期时间

    list($filename,$pid,$key,$ttl) = $argv;

    if ($pid === null || $key === null ||$ttl === null)
    {
        exit("参数不对");
    }

    $start_time = time();

    cli_set_process_title('php-lock-watch-dog');

    //至少睡1秒
    $sleep_time = max(intval($ttl*1000/3),1000000);

    require_once __DIR__ . '/../src/RedLock.php';
    $servers = [
        ['127.0.0.1', 6379, 0.01],
        //['127.0.0.1', 6378, 0.01],
    ];
    $redLock = new RedLock($servers);

    $i = 0;
    //每隔一段时间判断上锁的进程是否存在,存在就给锁续期
    while (Process::kill($pid,0))
    {
        $redLock->renewal($key,$ttl);
        $i++;
        var_dump("第{$i}次,续锁完成,pid:{$pid},间隔:{$sleep_time}微秒\n");
        usleep($sleep_time);
    }
    $work_time = time() - $start_time;

    echo "pid:{$pid},执行完了{$work_time}秒\n";