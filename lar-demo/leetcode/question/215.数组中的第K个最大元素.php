<?php

class Solution {

    function findKthLargest($nums, $k) {
        for($i = 0;$i < $k;$i++){
            $max = max($nums);
            $key = array_search($max,$nums);
            unset($nums[$key]);
        }
        return $max;
    }

}


$s = new Solution();

$res = $s->findKthLargest([3,2,3,1,2,4,5,5,6],4);
var_dump($res);