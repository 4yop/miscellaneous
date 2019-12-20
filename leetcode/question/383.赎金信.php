<?php
//383. 赎金信
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function canConstruct($ransomNote, $magazine) {
        $end = strlen($ransomNote);
        $i = 0;
        while($i < $end){
            $index = strpos($magazine,$ransomNote[$i]);
            if($index !== false){
                $magazine[$index] = ' ';
            }else{
                return false;
            }
            $i++;
        }
        return true;
    }
}


    $solution = new Solution();
    $res = $solution->canConstruct("aa","aab");
    var_dump($res);

