<?php


class Solution {

    /**
     * @param Integer[][] $matrix
     * @return Integer[]
     */
    function findDiagonalOrder($matrix) {
        $m = count($matrix);
        $n = count($matrix[0]);
        
    }
}

$arr = [
    [ 1, 2, 3 ],
    [ 4, 5, 6 ],
    [ 7, 8, 9 ]
];

$res = (new Solution)->findDiagonalOrder($arr);

var_dump($res);