<?php
$time = 100;
$sec = 1;
ini_set("display_errors", "On");
error_reporting(E_ALL);
while (true) {
    $rand = get_rand_str();
    $command = "git pull && git add -A && git commit -m '{$rand}' && git push";
    echo "\n第".$sec++."次执行".date('Y-m-d H:i:s')."\n";
    echo "命令:{$command}\n";
    echo "\n-------------------------------------------------------------------------\n";
    exec($command);
    echo "-------------------------------------------------------------------------\n\n";
    sleep($time);
}

function get_rand_str()
{
    //$str = get_char(10).com_create_guid().get_char(10);
    $str = com_create_guid();
    $arr = mb_str_split($str);
    shuffle($arr);
    return implode('',$arr);
}

function com_create_guid($_ = false) {

    $uid =  sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        mt_rand( 0, 0xffff ),

        mt_rand( 0, 0x0fff ) | 0x4000,

        mt_rand( 0, 0x3fff ) | 0x8000,

        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )

    );
    return str_replace('-','',$uid);
}
function get_char($num)  // $num为生成汉字的数量
{
    $b = '';
    for ($i=0; $i<$num; $i++) {
        // 使用chr()函数拼接双字节汉字，前一个chr()为高位字节，后一个为低位字节
        $a = chr(mt_rand(0xB0,0xD0)).chr(mt_rand(0xA1, 0xF0));
        // 转码
        $b .= iconv('GB2312', 'UTF-8', $a);
    }
    return $b;
}
function mb_str_split($str)
{
    return preg_split('/(?<!^)(?!$)/u', $str );
}