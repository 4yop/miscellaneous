<?php


class Solution {


    function twoSum($numbers, $target) {
        $i = 0;
        $j = count($numbers) - 1;
        while($i < $j){
            $sum = $numbers[$i] + $numbers[$j];
            if($sum == $target){
                return [$i+1,$j+1];
            }else if($sum < $target){
                $i++;
            }else{
                $j--;
            }
        }
    }
}





