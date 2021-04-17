<?php
class Solution {

    /**
     * @param Integer[] $prices
     * @return Integer
     */
    //双指针
    function reverseVowels($s) {
        $vowel = 'aeiou';
        $strlen = strlen($s);
        $i = 0;
        $j = $strlen - 1;
        while($i < $j){
            while($i < $j && stripos($vowel,$s[$i]) === false){
                $i++;
            }
            while($i < $j && stripos($vowel,$s[$j]) === false){
                $j--;
            }

            $temp = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $temp;

            $i++;
            $j--;
        }
        return $s;
    }


}

$s = new Solution();
$r = $s->reverseVowels("ai");
var_dump($r);