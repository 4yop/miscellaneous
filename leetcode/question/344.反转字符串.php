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
}

$solution = new Solution();
$res = $solution->reverseString(["h","e","l","l","o"]);
var_dump($res);