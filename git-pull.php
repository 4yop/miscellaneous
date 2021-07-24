<?php
$time = 100;
$sec = 1;
while (true) {
    echo "第".$sec++."次执行".date('Y-m-d H:i:s')."\n";
    $command = "git add -A && git commit -m 'dfglkshgsdlkf' && git push";
    exec($command);
    sleep($time);
}