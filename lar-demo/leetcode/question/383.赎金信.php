<?php
//383. 赎金信
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function canConstruct1($ransomNote, $magazine) {
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

    function canConstruct($ransomNote, $magazine) {
        $a = count_chars($ransomNote,1);
        $b = count_chars($magazine,1);
        foreach ($a as $k=>$v)
        {
            if (!isset($b[$k]) || $v > $b[$k])
            {
                return false;
            }
        }
        return true;
    }
}


    $solution = new Solution();
    $res = $solution->canConstruct("aa","aab");
    var_dump($res);

