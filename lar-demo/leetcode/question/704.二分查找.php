<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search($nums, $target) {


        $start = 0;
        $end = count($nums) - 1;

        while($start <= $end){
            $mid = (int)( ($start + $end)/2 );
            if($target == $nums[$mid]){
                return $mid;
            }
            if($target > $nums[$mid]){
                $start = $mid + 1;
            }else{
                $end = $mid - 1;
            }
        }

        return -1;
    }
}

$res = (new Solution)->search( [5],
    5);

var_dump($res);