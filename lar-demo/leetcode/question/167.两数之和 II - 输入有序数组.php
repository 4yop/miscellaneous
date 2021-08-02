<?php
class Solution {

    /**
     * @param Integer[] $numbers
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($numbers, $target) {
        $map = [];
        foreach ($numbers as $k => $n)
        {
            $diff = $target - $n;
            if (isset($map[$diff]))
            {
                return [$map[$diff]+1,$k+1];
            }
            $map[$n] = $k;
        }

    }
    //O(n) O(1)
    function twoSum1($numbers, $target) {
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


$solution = new Solution();

$res = $solution->twoSum( [2, 7, 11, 15], 9);
print_r($res);
