<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function containsDuplicate($nums) {
        $arr = [];
        foreach($nums as $v){
            if( isset($arr[$v]) ){
                return true;
            }else{
                $arr[$v] = 1;
            }
        }
        return  false;
    }
}