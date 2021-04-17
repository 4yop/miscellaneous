<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2020/1/2
 * Time: 14:31
 */

class Solution {

    /**
     * @param String $a
     * @param String $b
     * @return String
     */
    function addBinary($a, $b) {

        $i = strlen($a) - 1;
        $j = strlen($b) - 1;
        if($i > $j){
            $long = $a;
            $short = $b;
        }else{
            $long = $b;
            $short = $a;
            $i = strlen($long) - 1;
            $j = strlen($short) - 1;

        }

        $temp = 0;
        while($i >= 0 || $j >= 0){
            $num2 = $j >= 0 ? intval($short[$j]) : 0;
            $val = intval($long[$i]) + $num2 + $temp;
            $temp = 0;
            if($val >= 2){
                $val-=2;
                $temp = 1;
            }
            $long[$i] = $val;
            $i--;
            $j--;
        }
        if($temp != 0){
            $long = $temp.$long;
        }
        return $long;
    }
}

$res = (new Solution())->addBinary("1","111");
var_dump($res);