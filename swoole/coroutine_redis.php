<?php
    /**
    *协程redis
    **/
    use Swoole\Coroutine\Redis;


    go(function(){

        $redis = new Redis();

        $redis->connect('127.0.0.1',6379);

//        $res = $redis->request(['object', 'encoding', 'key1']);
//        print_r($res);

        //配置
//        $redis->setOptions([
//            'connect_timeout' => 1,//连接的超时时间
//            'timeout' => -1,
//            'serialize' => false,
//              'compatibility_mode' => true//协程redis 和phpredis返回的结果一致
//        ]);


        $redis->setDefer();
        //$redis->multi();
        $redis->set('key1','val1');
        $result1 = $redis->recv();

        $redis->get('key1');
        $result2 = $redis->recv();
        //$result3 = $redis->exec();
        //print_r($redis);

        print_r([
            '错误' => $redis->errMsg ? $redis->errMsg : '无',
            '错误码' => $redis->errCode,
        ]);

        print_r(compact('result1','result2'));



    });


