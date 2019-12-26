<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function hammingWeight($n) {
        if ($n == 0) return 0;
        $result = 1;
        while ($n > 2) {
            $result += $n % 2;
            $n = floor($n / 2);
        }
        return $result;
    }

    

}

$s = new Solution();

$res = $s->hammingWeight(00000000000000000000000000001011);
var_dump($res);







