<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
//344. 反转字符串
class Solution {


    function increasingTriplet($nums) {
        $one = PHP_INT_MAX;
        $two = PHP_INT_MAX;

        foreach($nums as $num){
            if($num <= $one){
                $one = $num;
            }else if($num <= $two){
                $two = $num;
            }else{
                return true;
            }
        }
        return false;


    }

}

$solution = new Solution();
$res = $solution->increasingTriplet([2,4,-2,-3]);
var_dump($res);