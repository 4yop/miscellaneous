<?php
    require_once 'helper.php';


    $redis = redis();


    $msgId = $redis->xAdd('test-stream','*',['a'=>'a','b'=>'b'],10);
    var_dump($msgId);
    $msgId = $redis->xAdd('test-stream','*',['c'=>'c','d'=>'d'],10);
    var_dump($msgId);