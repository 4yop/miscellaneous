<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function singleNumber($nums) {
        sort($nums);
        $count = count($nums);
        for($i = 0;$i < $count;$i++){
            if($nums[$i] !== $nums[$i-1] && $nums[$i] !== $nums[$i+1]){
                return $nums[$i];
            }
        }

        return $nums[$i];
    }
}

$s = new Solution();
$r = $s->singleNumber([2,2,1]);
var_dump($r);