<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Float
     */
    function findMaxAverage($nums, $k) {
        $res = PHP_FLOAT_MIN;
        $count = count($nums);
        $end = $count - $k;
        $sum = 0;

        for ($i = 0;$i < $k;$i++)
        {
            $sum += $nums[$i];
        }
        $res = max($res,$sum);

        for($i = 1;$i <= $end;$i++)
        {
            $sum = $sum - $nums[$i-$k] + $nums[$i];
            $res = max($res,$sum);
        }

        return $res/$k;
    }
}

$s = new Solution();
$r = $s->findMaxAverage([1,12,-5,-6,50,3],4);
var_dump($r);
