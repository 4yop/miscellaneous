<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    //hash表 算法
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
    //set解法
    function containsDuplicate1($nums) {
        $count = count($nums);

        if($count <= 1){
            return false;
        }

        $set = [$nums[0]];
        for($i = 1;$i < $count;$i++){
            if(in_array($nums[$i],$set)){
                return true;
            }
            $set[] = $nums[$i];
        }
        return false;
    }
}