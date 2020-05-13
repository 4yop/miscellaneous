<?php
    class Solution {

        /**
         * @param String $s
         * @return Boolean
         */
        function canPermutePalindrome($s) {
            $arr = array_count_values(str_split($s));
            $odd_num = 0;
            foreach($arr as $v){
                if($v%2 != 0){
                    $odd_num++;
                }
                if($odd_num > 1){
                    return false;
                }
            }
            return $odd_num < 2;
        }
    }
    $s = new Solution();
    $r = $s->canPermutePalindrome("code");
    var_dump($r);