<?php
class Solution {

    /**
     * @param Integer $columnNumber
     * @return String
     */
    function convertToTitle($columnNumber) {
        $start = 65;

        return chr($columnNumber%$start);

    }
}


$s = new Solution();

$r = $s->convertToTitle(2);

var_dump($r);
