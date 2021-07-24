<?php
$time = 100;
$sec = 1;

while (true) {
    $rand = getChar(10).com_create_guid().getChar(10);
    $command = "git pull && git add -A && git commit -m '{$rand}' && git push";
    echo "\n第".$sec++."次执行".date('Y-m-d H:i:s')."\n";
    echo "命令:{$command}\n";
    echo "\n-------------------------------------------------------------------------\n";
    exec($command);
    echo "-------------------------------------------------------------------------\n\n";
    sleep($time);
}

function com_create_guid() {

    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        mt_rand( 0, 0xffff ),

        mt_rand( 0, 0x0fff ) | 0x4000,

        mt_rand( 0, 0x3fff ) | 0x8000,

        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )

    );

}
function getChar($num)  // $num为生成汉字的数量
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