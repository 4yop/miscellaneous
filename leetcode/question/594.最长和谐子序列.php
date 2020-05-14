<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function findLHS($nums) {
        $arr = array_count_values($nums);
        $res = 0;
        foreach($arr as $k=>$v){
            if(isset($arr[$k+1]) && $v+$arr[$k+1] > $res){
                $res = $v+$arr[$k+1];
            }
        }
        return $res;
    }
}