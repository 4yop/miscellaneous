<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Boolean
     */
    function checkSubarraySum($nums, $k)
    {
        $m = count($nums);
        if ($m < 2)
        {
            return false;
        }
        $map = [];
        $map[0] = -1;
        $remainder = 0;
        foreach ($nums as $key=>$val)
        {
            $remainder = ($remainder+$val)%$k;
            if (isset($map[$remainder]))
            {
                $prevIndex = $map[$remainder];
                if ($key - $prevIndex >= 2)
                {
                    return true;
                }
            }else{
                $map[$remainder] = $key;
            }
        }
        return false;
    }
}



$s = new Solution();

$nums = [23,2,4,6,6];
$k = 7;
$r = $s->checkSubarraySum($nums,$k);

var_dump($r);
