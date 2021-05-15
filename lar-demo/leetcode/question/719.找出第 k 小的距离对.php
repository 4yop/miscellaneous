<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function smallestDistancePair($nums, $k)
    {
        sort($nums);

        $count = count($nums);

        $i = 0;
        while ($i < $count)
        {

        }

    }
}

// 10  100 1000 10000 1000000  1000000000 10000000000000

$nums = [1,3,2,34,345,45,46,546,456,1];
$k = 9;


$res = (new Solution)->smallestDistancePair($nums,$k);

var_dump($res);
