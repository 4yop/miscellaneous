<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function singleNumber($nums) {
        return array_search(1,array_count_values($nums));
    }
}

$s = new Solution();
$res = $s->singleNumber([4,1,2,1,2]);
print_r($res);