<?php

//fwrite(STDOUT,"请输入消息:");
//$msg = trim(fgets(STDIN));echo $msg;return;
/**
 * 二分查找
 */
    declare (strict_types = 1);
    $oldprince = 0;
    $price = 0;
    $i = 0;

    fwrite(STDOUT,'set goods price:');

    $oldprince = intval(fgets(STDIN));

    //print_r(fgets(STDIN));

    while($oldprince != $price){
        $i++;
        fwrite(STDOUT,'please input your guess price:');
        $price = intval(fgets(STDIN));
        if($oldprince > $price){

            echo "less than \n";
        }elseif($oldprince < $price){

            echo "more than\n";
        }else{
            echo "guess is right,count:{$i} \n";
        }
    }

    return 0;