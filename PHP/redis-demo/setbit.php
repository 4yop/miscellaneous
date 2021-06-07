<?php

require "helper.php";
error_reporting(E_ALL);
ini_set("display_errors", "On");


$str = 'hello';

$arr = [];

for($i = 0;$i < strlen($str);$i++)
{
    $arr[] = "0".decbin(ord($str[$i]));
}

var_dump($arr);
$num = -1;
foreach ($arr as $k=>$v)
{

    for($i = 0;$i < strlen($v);$i++)
    {
        $num += 1;
        if ($v[$i] == 0)
        {
            continue;
        }
        echo $num."\n";
        redis()->setBit('s',$num,$v[$i]);
    }
    echo "---\n";
}


$a = redis()->get('s');
var_dump($a);