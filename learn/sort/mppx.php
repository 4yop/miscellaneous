<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/21
 * Time: 14:16
 */
/**
 * 冒泡排序
 */

    fwrite(STDOUT,'共有几个数:');
    $n = fgets(STDIN);
    $arr = [];
    //n
    for($i = 0;$i < $n;$i++) {

        fwrite(STDOUT, "input values {$i}:");

        $val = fgets(STDIN);

        $arr[$i] = $val;
    }
    
    $count = 0;
    for($i = 0;$i < $n - 1;$i++){

        for($j = 0;$j < $n - $i;$j++){
            if($arr[$j] < $arr[$j+1]){
                $temp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;
            }
            $count++;
        }

    }


    //echo $count;
    print_r($arr);
    // O(N  2 )