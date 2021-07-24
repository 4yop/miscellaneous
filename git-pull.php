<?php
$time = 100;
$sec = 1;
$command = "git pull && git add -A && git commit -m 'dfglkshgsdlkf' && git push";
while (true) {
    echo "\n第".$sec++."次执行".date('Y-m-d H:i:s')."\n";
    echo "命令:{$command}\n";
    echo "\n-------------------------------------------------------------------------\n";
    exec($command);
    echo "-------------------------------------------------------------------------\n\n";
    sleep($time);
}