<?php
//27. 移除元素

class Solution {


    function removeElement(&$nums, $val) {

        foreach ($nums as $k=>$v){
            if($v === $val){
                unset($nums[$k]);
            }
        }
        return count($nums);
    }
}


$solution = new Solution();
$nums = [3,2,2,3];
$res = $solution->removeElement($nums,3);
print_r($res);