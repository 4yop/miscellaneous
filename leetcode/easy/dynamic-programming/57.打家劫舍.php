<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function maxSubArray($nums) {
        for($i=1;$i<count($nums);$i++)
            $nums[$i] = max($nums[$i],$nums[$i]+$nums[$i-1]);
        return max($nums);
    }

}

$s = new Solution();

$res = $s->maxSubArray([-2,1,-3,4,-1,2,1,-5,4]);
var_dump($res);







