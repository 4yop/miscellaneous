<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function singleNumbers($nums) {
        $arr = array_count_values($nums);
        $res = [];
        foreach($arr as $k => $v){
            if($v < 2){
                $res[] = $k;
            }
        }
        return $res;
    }
}