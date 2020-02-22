<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {

        $end = count($nums) - 1;
        $i = 0;
        while($i < $end){
            $j = $i+1;
            while($j <= $end){
                if($nums[$i]+$nums[$j] == $target){
                    return [$i,$j];
                }
                while($nums[$j] === $nums[$j+1]){
                    $j++;
                }
                $j++;
            }

            $i++;

        }

    }
}

$s = new Solution();
$res = $s->twoSum([1,1,2,3],3);
print_r($res);