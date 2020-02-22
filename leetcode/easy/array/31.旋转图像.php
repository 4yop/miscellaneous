<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    /**
     *
     *  [1,2,3],
        [4,5,6],
        [7,8,9],

     * [7,8,9],
     * [4,5,6],
     * [1,2,3],
     *
     *
     */
    function rotate($matrix) {
        $n = count($matrix);
        $matrix = array_reverse($matrix);
        for($i = 0;$i < $n;$i++){
            for($j = $i + 1;$j < $n;$j++){
                $temp = $matrix[$i][$j];
                $matrix[$i][$j] = $matrix[$j][$i];
                $matrix[$j][$i] = $temp;
            }
        }
        return $matrix;
    }
}
$matrix = [
    [1,2,3],
    [4,5,6],
    [7,8,9],
];
    $s = new Solution();
$res = $s->rotate($matrix);
print_r($res);