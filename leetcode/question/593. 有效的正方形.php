<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 16:25
 */
//593. 有效的正方形

function validSquare($p1, $p2, $p3, $p4) {




    $getLong = function($l1,$l2){
        return pow($l1[0] - $l2[0],2) + pow($l1[1] - $l2[1],2);
    };

    $long1 = $getLong($p1,$p4);
    $long2 = $getLong($p2,$p4);
    if($long1 != $long2){
        echo "$long1 ------- $long2";
        return false;
    }
    $long3 = $getLong($p3,$p1);
    if($long1 != $long3){
        echo "$long1 ------- $long3";
        return false;
    }
    $long4 = $getLong($p2,$p3);
    if($long1 != $long4){
        echo "$long1 ------- $long4";
        return false;
    }
    $xie = $getLong($p1,$p4);

    $sum = pow($long1,2) + pow($long4,2);
    if($sum == $xie){
        return true;
    }
    echo "$long4---- $xie ------- $sum";
    return false;
}

$p1 = [0,0];$p2 = [1,1];$p3 = [1,0];$p4 = [0,1];

$res = validSquare($p1,$p2,$p3,$p4);
var_dump($res);