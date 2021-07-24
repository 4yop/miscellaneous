<?php
$time = 100;
$sec = 1;
while (true) {
    echo "\n第".$sec++."次执行".date('Y-m-d H:i:s')."\n";
    echo "\n-------------------------------------------------------------------------\n";
    $command = "git add -A && git commit -m 'dfglkshgsdlkf' && git push";
    exec($command);
    echo "-------------------------------------------------------------------------\n\n";
    sleep($time);
}