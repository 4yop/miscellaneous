<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function majorityElement($nums) {
        $n = count($nums)/2;
        $arr = array_count_values($nums);
        foreach($arr as $k => $v){
            if($v > $n){
                return $k;
            }
        }
    }
}