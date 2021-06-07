<?php
require "helper.php";
error_reporting(E_ALL);
ini_set("display_errors", "On");

$arr = range(1,1000);
$redis = redis();
$time = time();

//161 开始误差
//foreach ($arr as $i=>$item)
//{
//    $redis->pfAdd("codehole_{$time}",["user_{$item}"]);
//    $total = $redis->pfCount("codehole_{$time}");
//    if ($total != $i+1)
//    {
//        echo "{$total} != ".($i+1)."\n";
//        break;
//    }
//}



$arr = range(1,100000);

foreach ($arr as $i=>$item)
{
    echo "$i\n";
    $redis->pfAdd("codehole_{$time}",["user_{$item}"]);
}

$total = $redis->pfCount("codehole_{$time}");
//99830 != 100000
echo "{$total} != 100000\n";
