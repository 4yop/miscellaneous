<?php


class Solution {


    function fourSumCount($A, $B, $C, $D) {
        $count = 0;
        foreach($A as $a){
            foreach($B as $b){
                foreach($C as $c){
                    foreach($D as $d){
                        if($a + $b + $c + $d == 0){
                            $count++;
                        }
                    }
                }
            }
        }
        return $count;
    }
}




$solution = new Solution();

$res = $solution->fourSumCount([1,2],
[-2,-1],
[-1,2],
[0,2]);
print_r($res);