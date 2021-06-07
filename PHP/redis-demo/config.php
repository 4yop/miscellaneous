<?php
    require_once 'helper.php';

    //$c = redis()->config("GET",'maxmemory*');


    $c1 = redis()->config("GET",'maxmemory');

    $c2 = redis()->config('GET','maxmemory-policy');

    $c3 = redis()->config('GET','maxmemory-samples');

    echo "分配的内存:{$c1['maxmemory']}\n";

    echo "淘汰策略:{$c2['maxmemory-policy']}\n";

    echo "随机采样个数:{$c3['maxmemory-samples']}\n";
