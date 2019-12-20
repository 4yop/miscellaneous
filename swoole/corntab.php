<?php
/**
 * 异步定时器
 */

$ms = 2000;//2秒执行一次
$i = 1;
$start = $_SERVER['REQUEST_TIME'];
$timer1 = swoole_timer_tick($ms,function($timer_id){

    echo "每2秒一次的定时器id:{$timer_id}\n";
});

$ms = 3000;
$timer2 = swoole_timer_after($ms,function(){
    echo "3秒只执行一次的定时器\n";
});

$ms = 10000;
swoole_timer_after($ms,function() use ($timer1,$timer2){
    echo "10秒后清除计时器:{$timer1},{$timer2}\n";
    swoole_timer_clear($timer1);
    swoole_timer_clear($timer2);
});

