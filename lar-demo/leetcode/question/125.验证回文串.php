<?php
class Solution {

    /**
     * @param Integer[] $prices
     * @return Integer
     */
    //双指针
    function isPalindrome($s) {
        $strlen = strlen($s);
        $i = 0;
        $j = $strlen - 1;
        while($i < $j){
            while($i < $j && !ctype_alnum ($s[$i])){
                $i++;
            }
            while($i < $j && !ctype_alnum ($s[$j])){
                $j--;
            }
            if(strtolower($s[$i]) != strtolower($s[$j])){
                return false;
            }
            $i++;
            $j--;
        }
        return true;
    }


}

$s = new Solution();
$r = $s->isPalindrome("OP");
var_dump($r);