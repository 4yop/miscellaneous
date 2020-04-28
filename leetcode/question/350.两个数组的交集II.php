<?php


class Solution {

    //set
    function intersect($nums1, $nums2) {

        $m = count($nums1);
        $n = count($nums2);
        if($m == 0 || $n == 0){
            return [];
        }
        $res = [];
        $dicts = array_count_values($nums1);
        foreach($nums2 as $v){
            if($dicts[$v] > 0){
                $res[] = $v;
                $dicts[$v]--;
            }
        }
        return $res;
    }


}



$solution = new Solution();

$res = $solution->intersect([1,2,2,1],[2,2]);
print_r($res);