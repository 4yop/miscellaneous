<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function isValidSudoku($board) {

        for($i = 0;$i<9;$i++){
            $row = [];//行
            $col = [];//列
            $cube = [];//3*3宫格
            for($j = 0;$j<9;$j++){
                if($board[$i][$j] != '.' && $row[ $board[$i][$j] ] == 1){
                    //echo "{$board[$i][$j]} 在第{$i}行重复了\n";
                    return false;
                }else{
                    $row[ $board[$i][$j] ] = 1;
                }
                if($board[$j][$i] != '.' && $col[ $board[$j][$i] ] == 1){
                    //echo "{$board[$j][$i]} 在第{$i}列重复了\n";
                    return false;
                }else{
                    $col[ $board[$j][$i] ] = 1;
                }

                $x = 3 * floor($i/3) + floor($j/3);
                $y = 3 * floor($i%3) + floor($j%3);
                if($board[$x][$y] != '.' && $cube[ $board[$x][$y] ] == 1){
                    //echo "{$board[$x][$y]} 在第3x3重复了\n";
                    return false;
                }else{
                    $cube[ $board[$x][$y] ] = 1;
                }


            }
        }
        return true;
    }
}

    $board = [
        ["5","3",".",".","7",".",".",".","."],
        ["6",".",".","1","9","5",".",".","."],
        [".","9","8",".",".",".",".","6","."],
        ["8",".",".",".","6",".",".",".","3"],
        ["4",".",".","8",".","3",".",".","1"],
        ["7",".",".",".","2",".",".",".","6"],
        [".","6",".",".",".",".","2","8","."],
        [".",".",".","4","1","9",".",".","5"],
        [".",".",".",".","8",".",".","7","9"]
    ];

    $s = new Solution();
$res = $s->isValidSudoku($board);
var_dump($res);