<?php
class Solution {


    function intersection($nums1, $nums2) {
        if(empty($nums1) || empty($nums2)){
            return [];
        }
        $res = [];
        $nums1 = array_unique($nums1);
        foreach($nums1 as $v){
            if(in_array($v,$nums2)){
                $res[] = $v;
            }
        }
        return $res;
    }
}

$s = new Solution();
$r = $s->intersection([1,2,2,1],[2,2]);
var_dump($r);