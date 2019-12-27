<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function findDuplicate($nums) {

        $end = count($nums) ;

        if($end == 2){
            return $nums[0];
        }
        sort($nums);
        for($i = 0;$i < $end;$i+=2){
            if(){

            }
        }

    }
}

$s = (new Solution())->findDuplicate([2,5,9,6,9,3,8,9,7,1] );
var_dump($s);