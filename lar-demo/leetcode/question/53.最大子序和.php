<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums) {

        $count = count($nums);
        $res = PHP_INT_MIN;
        for ($i = 0;$i < $count;$i++)
        {
            $sum = $nums[$i];
            $res = max($res,$sum);
            for($j = $i+1;$j < $count;$j++)
            {
                $sum += $nums[$j];
                $res = max($res,$sum);
            }


        }
        return $res;
    }
}


$s = new Solution();
$nums = [-2,1,-3,4,-1,2,1,-5,4];
$r = $s->maxSubArray($nums);
var_dump($r);
