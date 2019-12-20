<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function isValidSudoku($board) {

        for($i = 0;$i<9;$i++){
            $rowCount = array_count_values($board[$i]);
            $columnCount = array_count_values(array_column($board,$i));
            unset($rowCount['.']);
            unset($columnCount['.']);
            if(array_sum($rowCount) != count($rowCount)){
                echo "第{$i}行\n";
                print_r($rowCount);
                return false;
            }
            if(array_sum($columnCount) != count($columnCount)){
                echo "第{$i}列\n";
                print_r($columnCount);
                return false;
            }

        }

        for($i = 0;$i < 9;$i++){

            $sxs = [];
            for($j = $i;$j<9;$j+=3){
                for($k = 0;$k<9;$k+=3){

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
print_r($res);