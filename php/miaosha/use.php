<?php

    for($i = 0;$i < 100;$i++){


    $user_id = rand(1,1000);
    $url = "http://tw.com/?user_id={$user_id}";
    echo file_get_contents($url);
    }