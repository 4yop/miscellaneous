<?php

    try {
        //加执行队列的程序
        include "Queue.class.php";

        $queue = new Queue($conn);

        $phpfile = "D:\wwwroot\miscellaneous\php\queue_task\add_queue.php";
        for ($i = 0; $i < 100; $i++) {
            $parame = "";
            for ($i = 0; $i < rand(1, 5); $i++) {
                $parame .= (uniqid() . "=" . uniqid() . "&");
            }
            echo $i.":".$parame."\n";
            $queue->add($phpfile, $parame);
        }
    }catch (Exception $e){
        exit($e->getMessage());
    }