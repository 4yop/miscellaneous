<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function isPowerOfThree($n) {

        return $n > 0 && strpos('.',log($n,3)) === false ? true : false;
    }
}

$s = new Solution();

$res = $s->isPowerOfThree(9);
var_dump($res);







