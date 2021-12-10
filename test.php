<?php

use Swoole\Coroutine\MySQL;
use function Swoole\Coroutine\run;
use Swoole\Coroutine;
use Swoole\Database\PDOConfig;
use Swoole\Database\PDOPool;
use Swoole\Runtime;
Runtime::enableCoroutine();

$max_coroutine = 10000;

Swoole\Coroutine::set(['max_coroutine'=>$max_coroutine]);
run(function () use ($max_coroutine) {
    $sql = "INSERT INTO `test_order` (`order_num`,`status`) VALUES(?,?)";
    $i = 0;
    $max = 10000000;


    $pool = new PDOPool((new PDOConfig)
        ->withHost('127.0.0.1')
        ->withPort(3306)
        // ->withUnixSocket('/tmp/mysql.sock')
        ->withDbName('test')
        ->withCharset('utf8mb4')
        ->withUsername('root')
        ->withPassword('rootroot')
    );


    $count = $max_coroutine;
    while ($i < $count) {
        Swoole\Coroutine\go(function () use ($pool,$sql,$i,$max,$count) {
            $db = $pool->get();
            $start = $i*(int)($max/$count);
            $end = $start + (int)($max/$count);
            for ($j = $start;$j < $end ;$j++) {
                $stmt = $db->prepare($sql);
                if ($stmt == false) {
                    var_dump($db->errno, $db->error);
                } else {
                    $ret2 = $stmt->execute([order_num($j), 1]);
                    if ($ret2) {
                        var_dump("$j:成功");
                    } else {
                        var_dump("$j:{$db->errno},{$db->error}");
                    }
                }
            }
        });

        $i++;
    }

});

function order_num($i)
{
    return date("YmdHis").str_pad($i,8,0,STR_PAD_LEFT);
}

