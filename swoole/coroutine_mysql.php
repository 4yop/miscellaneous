<?php

/**
 * 启用协程MySQL客户端
 */
go(function(){
    $swoole_mysql = new Swoole\Coroutine\MySQL();

    $swoole_mysql->connect([
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'root',
        'password' => 'root',
        'database' => 'swoole',
    ]);

    try {
        $swoole_mysql->begin();

        $sql = 'SHOW DATABASES';
        $res = $swoole_mysql->query($sql, $time = 10);

        print_r([
            '标题' => "执行语句{$sql}",
            '结果' => json_encode($res),
        ]);


        //预处理请求
        $sql = "SELECT * FROM `test` where `id` = ? or `id` = ?";
        $stmt = $swoole_mysql->prepare($sql);
        if ($stmt == false) {
            print_r(
                [
                    '标题' => "{$sql}有问题",
                    '错误' => $swoole_mysql->error,
                    '错误码' => $swoole_mysql->errno
                ]
            );
        } else {
            $data = [1, 10];
            $res = $stmt->execute($data);
            print_r(
                [
                    '标题' => "执行{$sql}",
                    '数据' => $data,
                    '结果' => $res
                ]
            );




        }
        $swoole_mysql->commit();
    }catch (Exception $e){
        $swoole_mysql->rollback();

        print_r(
            [
                '标题' => "抓到错误",
                '错误' => $e->getMessage(),
            ]
        );

    }

});

