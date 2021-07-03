<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer[]
     */
    function topKFrequent($nums, $k) {
        $arr = array_count_values($nums);
        arsort($arr);
        $res = [];
        $i = 0;
        foreach($arr as $key=>$v){
            if($i == $k){
                return $res;
            }
            $res[] = $key;
            $i++;

        }
        return $res;
    }
}
