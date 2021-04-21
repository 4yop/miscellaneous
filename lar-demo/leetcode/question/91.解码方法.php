<?php

class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function numDecodings($s) {
        $start = 40;
        $sum = 0;
        for ($i = 0;$i < strlen($s);$i++)
        {
            $sum += (ord($s[$i]) + $start);
        }
        return $sum;
    }
}


$s = new Solution();

