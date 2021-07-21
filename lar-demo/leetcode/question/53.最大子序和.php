<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums) {

        $pre = 0;
        $max = $nums[0];
        foreach ($nums as $n)
        {
            $pre = max($pre+$n,$n);
            $max = max($max,$pre);
        }
        return $max;
    }
}


$s = new Solution();
$nums = [-2,1,-3,4,-1,2,1,-5,4];
$r = $s->maxSubArray($nums);
var_dump($r);
