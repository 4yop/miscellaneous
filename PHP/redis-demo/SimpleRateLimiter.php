<?php
require "helper.php";

class SimpleRateLimiter
{
    /**
     * @var \Redis
     */
    private $redis;

    public function __construct(\Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param string $user_id 用户id
     * @param string $action_key
     * @param int $period 间隔时间
     * @param int $max_count 最大阈值
     * @return bool
     */
    public function isActionAllowed(string $user_id,string $action_key,int $period,int $max_count):bool
    {
        $key = sprintf('test:hist:%s:%s',$user_id,$action_key);
        $noew_ts = msectime();
        $this->redis->multi($this->redis::PIPELINE);
        $this->redis->zAdd($key,$noew_ts,$noew_ts);
        $this->redis->zRemRangeByScore($key,0,$noew_ts - $period*1000);
        $this->redis->zCard($key);
        $this->redis->expire($key,$period+1);
        list($a,$b,$count) = $this->redis->exec();
        $this->redis->close();
        return $count <= $max_count;
    }

}

//毫秒时间戳
function msectime()
{
    list($msec, $sec) = explode(' ', microtime());
    $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    return $msectime;
}


$redis = redis();
$limiter = new SimpleRateLimiter($redis);

for($i=0;$i<20;$i++) {
   $r = $limiter->isActionAllowed("laoqian", "reply", 60, 5);
   var_dump($r);
}