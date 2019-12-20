<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function rotate($matrix) {
        $row = count($matrix[0]) - 1;
        $column = count($matrix) - 1;
        $x = 0;
        for($j = 0;$j<=$row;$j++){
            $y = 0;
            for ($i = $column;$i>=0;$i--){
                $res[$x][$y] = $matrix[$i][$j];
                $y++;
            }
            $x++;
        }
        return $res;
    }
}
$matrix = [
    [ 5, 1, 9,11],
    [ 2, 4, 8,10],
    [13, 3, 6, 7],
    [15,14,12,16]
];
    $s = new Solution();
$res = $s->rotate($matrix);
print_r($res);