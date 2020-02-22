<?php
    use Swoole\Coroutine\System;

    fwrite(STDOUT,"输入手机格式:\n(如：130*****106)");
    $sprint = trim(fgets(STDIN));

    if(strlen($sprint) != 11){
        echo "{$sprint}:格式不正确:".strlen($sprint) ."\n";
        exit;
    }





    $fp = fopen("data.txt", "a");
    go(function () use ($sprint,$fp)
    {
        $redis = new Swoole\Coroutine\Redis();
        $redis->connect('127.0.0.1', 6379);

        $insert = function($mid,$mobile,$city,$pro,$op) use ($redis){
            $id = $mid;
            $log = "{$id},{$mobile},{$city},{$pro},{$op}\n";

            $res = $redis->set("m:$id",$log);
            if($res){
                echo "写入成功:$log";
            }else{
                echo "写入失败:$log";
                die();
            }
            return $res;
        };

        $get = function($mobile){
            $url = "http://mobsec-dianhua.baidu.com/dianhua_api/open/location?tel={$mobile}";
            $res = file_get_contents($url);
            $res = json_decode($res,true);
            if(!$res  || !$res['response'] || !isset($res['response'][$mobile]['detail']) ){
                return false;
            }else{
                $re = $res['response'][$mobile]['detail'];
                $city = $re['area'][0]['city'];
                $pro  = $re['province'];
                $op   = $re['operator'];

                return compact('city','pro','op');
            }
        };

        $id = $redis->get("mid");
        $start = intval($id) ? intval($id) + 1 : 0;


        for($i = $start;$i<= 99999;$i++){

            $mid = str_pad($i,5,0,STR_PAD_LEFT );
            $mobile = str_replace("*****",$mid,$sprint);
            $redis->set("mid",$mid);
            $data = $get($mobile);
            if($data === false){
                echo "{$mobile}:查询失败\n";
            }else{
                echo "{$mobile}:查询成功\n";
                $res = $insert($mid,$mobile,$data['city'],$data['pro'],$data['op']);
            }
        }
    });