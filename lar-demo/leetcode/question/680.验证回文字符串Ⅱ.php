<?php
//648. 单词替换

class Solution {

    /**
     * @param String $s
     * @return Boolean
     */
    function validPalindrome($s) {
        if($s == strrev($s)){
            return true;
        }

        $i = 0;
        $j = strlen($s) - 1;
        $num = 0;

        return true;
    }
}




$solution = new Solution();

$res = $solution->validPalindrome("abca");
var_dump($res);