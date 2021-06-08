<?php
require "helper.php";
error_reporting(E_ALL);
ini_set("display_errors", "On");

$redis = redis();

$arr = range(1,100000);

foreach ($arr as $i=>$item)
{
    echo $i;
    $redis->rawCommand('bf.add','test-bf',"user_{$i}");

    $ret = $redis->rawCommand("bf.exists", 'test-bf', "user_{$i}");
    if ($ret == 0)
    {
        //echo "{$i}\n";
        break;
    }
}
