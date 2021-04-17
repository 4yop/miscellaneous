<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Boolean
     */
    function containsNearbyDuplicate($nums, $k) {
        $arr = [];
        foreach($nums as $key => $value){
            if(isset($arr[$value]) && ($key - $arr[$value]) <= $k){
                return true;
            }
            $arr[$value] = $key;
        }
        return false;
    }

}


$s = new Solution();

$res = $s->containsNearbyDuplicate([1,2,3,1],3);
var_dump($res);