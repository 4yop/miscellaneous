<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function isPowerOfThree($n) {
        return $n > 0 && 1162261467 % $n == 0;
    }
}
$s = new Solution();

$res = $s->isPowerOfThree(9);
var_dump($res);







