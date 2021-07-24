<?php
$time = 100;
$sec = 1;

while (true) {
    $rand = com_create_guid();
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