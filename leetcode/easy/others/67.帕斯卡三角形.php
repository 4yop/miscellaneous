<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function generate($numRows) {

        if($numRows == 0){
            return [];
        }elseif($numRows == 1){
            return [[1]];
        }
        $arr = [ [1],[1,1] ];
        if($numRows == 2){
            return $arr;
        }
        for($i = 2;$i<$numRows;$i++){
            $arr[$i][0]  = 1;

            for($j=1;$j<$i;$j++){
                $arr[$i][$j] = $arr[$i-1][$j] + $arr[$i-1][$j-1];
            }

            $arr[$i][$i] = 1;
        }
        return $arr;
    }

    

}

$s = new Solution();

$res = $s->generate(5);
var_dump($res);







