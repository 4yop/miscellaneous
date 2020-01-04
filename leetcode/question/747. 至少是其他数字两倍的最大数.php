<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function dominantIndex($nums) {

        $max = array_sum($nums);

        $lower = $max / 2;

        $num = 0;

        foreach ($nums as $k => $v){

        }

    }
}

$res = (new Solution)->dominantIndex([3, 6, 1, 0]);

var_dump($res);