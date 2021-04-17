<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
//344. 反转字符串
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function reverseString($s) {
        $i = 0;
        $j = count($s) - 1;

        while($i < $j){
            $temp = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $temp;
            $i++;
            $j--;
        }
        return $s;
    }
    //递归
    function reverseString1($s){
        $i = 0;
        $j = count($s) - 1;
        return $this->helper($i,$j,$s);
    }

    function helper($i,$j,$s){
        if($i < $j){
            $temp = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $temp;
            $i++;
            $j--;
            $s = $this->helper($i,$j,$s);
        }
        return $s;
    }
}

$solution = new Solution();
$res = $solution->reverseString1(["h","e","l","l","o"]);
var_dump($res);