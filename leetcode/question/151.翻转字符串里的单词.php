<?php
class Solution {

    /**
     * @param String $s
     * @return String
     */
    function reverseWords($s) {

        $str = implode(' ',array_filter(array_reverse(explode(' ',$s))));
        return $str;

    }
}