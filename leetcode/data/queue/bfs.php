<?php

    $arr =

        [
            'val' => 1,
            'left' => [
                'val' => 2,
                'left' => [
                    'val' => 4,
                    'left' => [],
                    'right' => [],
                ],
                'right' => [
                    'val' => 5,
                    'left' => [],
                    'right' => [],
                ],
            ],
            'right' => [
                'val' => 3,
                'left' => [
                    'val' => 6,
                    'left' => [],
                    'right' => [],
                ],
                'right' => [
                    'val' => 7,
                    'left' => [],
                    'right' => [],
                ],
            ]
        ];


    $queue = [];

    array_push($queue,$arr);

    while(!empty($queue)){
        $current = array_shift($queue);
        echo $current['val']."\n";
        if($current['left']){
            array_push($queue,$current['left']);
        }
        if($current['right']){
            array_push($queue,$current['right']);
        }
    }
    echo "完事\n";



