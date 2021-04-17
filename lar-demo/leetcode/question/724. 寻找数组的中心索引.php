<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function pivotIndex($nums) {
        if(empty($nums)){
            return -1;
        }
        $sum = array_sum($nums);
        $leftSum = 0;
        foreach ($nums as $k => $v){
            if($leftSum == $sum - $leftSum - $v){
                return $k;
            }
            $leftSum += $v;
        }
        return -1;
    }
}

$res = (new Solution)->pivotIndex( [-1,-1,-1,-1,-1,0]);

var_dump($res);