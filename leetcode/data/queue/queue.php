<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/27
 * Time: 9:32
 */
//队列 先入先出


    $queue = [1,2,3,4,5];

    $i = 0;
    $end = 5;

    while($i < $end){

        array_shift($queue);//弹出第一个
        array_push($queue,end($queue)+1);//尾部加

        //array_unshift($array,'');//头加
        //array_pop($array);//尾弹
        $i++;
    }

    print_r($queue);


