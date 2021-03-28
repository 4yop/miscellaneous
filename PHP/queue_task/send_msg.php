<?php


    $para = $argv[1];
    $arr = unserialize($para);


    echo rand(0,pow(2,31)).json_encode($arr)."\n";
