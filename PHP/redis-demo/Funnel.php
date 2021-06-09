<?php

error_reporting(E_ALL);
ini_set("display_errors", "On");

//漏斗限流
class Funnel
{
    /**漏斗容量
     * @var int
     */
    private $capacity;

    /**漏嘴流水速率
     * @var float
     */
    private $leaking_rate;

    /**漏斗剩余空间
     * @var int
     */
    private $left_quota;

    /**上一次漏水时间
     * @var float
     */
    private $leaking_ts;


    public function __construct (int $capacity,float $leaking_rate)
    {
        $this->capacity = $capacity;# 漏斗容量
        $this->leaking_rate = $leaking_rate;# 漏嘴流水速率
        $this->left_quota = $capacity;# 漏斗剩余空间
        $this->leaking_ts = msectime();# 上一次漏水时间
    }

    public function makeSpace():void
    {
        $now_ts = msectime();
        $delta_ts = $now_ts - $this->leaking_ts;# 距离上一次漏水过去了多久
        $delta_quota = (int)($delta_ts * $this->leaking_rate);# 又可以腾出不少空间了
        if ($delta_quota < 1)# 腾的空间太少，那就等下次吧
        {
            return;
        }
        $this->left_quota += $delta_quota;# 增加剩余空间
        $this->leaking_ts = $now_ts;# 记录漏水时间
        if ($this->left_quota > $this->capacity)# 剩余空间不得高于容量
        {
            $this->left_quota = $this->capacity;
        }
    }

    public function watering(int $quota):bool
    {
        $this->makeSpace();
        echo "{$this->left_quota} >= {$quota}\n";
        if ($this->left_quota >= $quota)# 判断剩余空间是否足够
        {
            $this->left_quota -= $quota;
            return true;
        }
        return false;
    }



}


class Test
{
    /**
     * @var Funnel
     */
    static $funnels = [];# 所有的漏斗

    # capacity  漏斗容量
    # leaking_rate 漏嘴流水速率 quota/s
    static function isActionAllowed(string $user_id, string $action_key, int $capacity, float $leaking_rate):bool
    {
        $key = sprintf('%s:%s',$user_id,$action_key);
        if (!isset(self::$funnels[$key]))
        {
            $funnel = new Funnel($capacity,$leaking_rate);
            $funnels[$key] = self::$funnels;
        }else
        {
            $funnel = self::$funnels[$key];
        }
        return $funnel->watering(1);
    }
}



//毫秒时间戳
function msectime()
{
    list($msec, $sec) = explode(' ', microtime());
    $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    return $msectime;
}



$arr = range(1,20);

foreach ($arr as $k=>$v)
{
    var_dump(Test::isActionAllowed('laoqian', 'reply', 15, 0.5));
}