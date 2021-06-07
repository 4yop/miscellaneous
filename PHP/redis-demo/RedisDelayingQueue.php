<?php

require_once 'D:\phpstudy_pro\new-lzh\miscellaneous\lar-demo\vendor\autoload.php';
require "helper.php";
error_reporting(E_ALL);
ini_set("display_errors", "On");
class RedisDelayingQueue
{
    private $redis;
    private $queueKey;



    public function __construct (\Redis $redis,string $queueKey)
    {
        $this->redis = $redis;
        $this->queueKey = $queueKey;



    }

    public function delay(array $msg)
    {
        $msg['id'] = \Ramsey\Uuid\Uuid::uuid4();
        $value = json_encode($msg);
        $retry_ts = time() + 5;
        $this->redis->zAdd("delay-queue",$retry_ts,$value);

    }

    public function loop ()
    {
        while (true)
        {
            $values = $this->redis->zRangeByScore("delay-queue",0,time(),['limit'=>[0,1]]);
            if ( count($values) < 1 )
            {
                sleep(1);
                continue;
            }
            $value = $values[0];
            $success = $this->redis->zRem("delay-queue",$value);
            if ($success)
            {
                $msg = json_decode($value,true);
                $this->handleMsg($msg);
            }
        }
    }

    //输出
    public function handleMsg($msg)
    {
        print_r($msg);
    }

}
$redis = redis();
$q = new RedisDelayingQueue($redis, "q-demo");
$q->delay(['as'=>'dfdf','dsfgdfg'=>'dsfsdfg']);
$q->loop();


