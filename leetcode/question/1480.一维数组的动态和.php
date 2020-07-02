<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function runningSum($nums) {
        $res = [$nums[0]];
        $count = count($nums);
        for($i = 1;$i < $count;$i++){
            $res[$i] = $res[$i-1] + $nums[$i];
        }
        return $res;
    }
}