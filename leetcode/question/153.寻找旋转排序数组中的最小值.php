<?php


class Solution {

    function findMin($nums) {

        $count = count($nums);
        if($count == 1){
            return $nums[0];
        }
        $min = $nums[0];
        $left = 0;
        $right = $count - 1;
        while($left <= $right){
            if($nums[$left] > $nums[$right] && $nums[$right] < $min){
                $min = $nums[$right];
                $right--;
            }else{
                break;
            }
        }
        return $min;
    }
}


$r = (new Solution())->findMin([3,4,5,1,2]);
var_dump($r);