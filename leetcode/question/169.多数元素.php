<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2020/1/17
 * Time: 11:21
 */

class Solution {

    /**
     * @param Integer $N
     * @return Integer
     */
    function majorityElement($nums) {
        $len = count($nums)/2;
        $arr = [];//统计
        foreach ($nums as $v){
            $arr[$v]++;
            if($arr[$v]>$len){
                return $v;
            }
        }
    }
}

$res = (new Solution())->majorityElement([3,2,3]);


var_dump($res);