<?php

class Solution {

    /**
     * @param Integer[] $arr
     * @return Integer[][]
     */
    function minimumAbsDifference($arr) {
        sort($arr);
        $diff = [];
        for ($i = 1;$i < count($arr);$i++){
            $diff[] = $arr[$i] - $arr[$i-1];
        }
        $min = min($diff);

        $res = [];
        for ($i = 1;$i < count($arr);$i++){
            if($arr[$i] - $arr[$i-1] == $min){
                $res[] = [$arr[$i-1],$arr[$i]];
            }

        }
        return $res;
    }
}

$solition = new Solution();
$arr = [4,2,1,3];
$res = $solition->minimumAbsDifference($arr);
print_r($res);