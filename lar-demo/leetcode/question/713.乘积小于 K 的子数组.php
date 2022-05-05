<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function numSubarrayProductLessThanK($nums, $k) {
        $res = 0;
        foreach ($nums as $key=>$num)
        {
            $product = 1;
            $j = $key;
            while ($j < count($nums))
            {
                $product = $product*$nums[$j];
                if ($product >= $k)
                {
                    break;
                }
                $res++;
                $j++;
            }
        }
        return $res;
    }
}

$s = new Solution();
$nums =  [10,5,2,6];
$k = 100;
$s->numSubarrayProductLessThanK($nums, $k);
