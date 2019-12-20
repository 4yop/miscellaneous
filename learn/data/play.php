<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/23
 * Time: 15:24
 */

    $a1 = [2,4,1,2,5,6];
    $a2 = [3,1,3,5,6,4];
    $temp = [];
    $i = 0;
    while(!empty($a2) && !empty($a1)){

        $v1 = array_shift ($a1);
        $k1 = array_search($v1,$temp);
        $temp[] = $v1;
        if($k1 !== false){
            $arr1 = array_slice($temp,$k1);
            $a1 = array_merge($a1,$arr1);
            $temp = array_slice($temp,0,$k1);
        }

        $v2 = array_shift ($a2);
        $k2 = array_search($v2,$temp);
        $temp[] = $v2;
        if($k2 !== false){
            $arr2 = array_slice($temp,$k2);
            $a2 = array_merge($a2,$arr2);
            $temp = array_slice($temp,0,$k2);
        }
        if($i == 100000000){
            break;
        }
        $i++;
    }

    print_r($a1);
    print_r($a2);
    print_r($temp);