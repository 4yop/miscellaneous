<?php


class Solution {

    function findMin($nums) {
        $count = count($nums);
        if( $count == 1 ){
            return $nums[0];
        }

        $left = 0;
        $right = $count - 1;

        while($left <= $right && $right - $left > 1){
            $mid = $left + floor(($right - $left)/2);
            if($nums[$left] <= $nums[$right]){
                return $nums[$left];
            }elseif($nums[$mid] < $nums[$left] && $nums[$left] > $nums[$right]){
                $right = $mid;
            }else{
                $left = $mid;
            }
        }
        return $nums[$left] > $nums[$right] ? $nums[$right] : $nums[$left];
    }
}


$r = (new Solution())->findMin(   [4,5,6,7,0,1,2]);
var_dump($r);