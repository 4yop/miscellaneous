<?php
class Solution {

    /**
     * @param Integer[] $A
     * @param Integer $m
     * @param Integer[] $B
     * @param Integer $n
     * @return NULL
     */
    function merge($A, $m, $B, $n) {
        array_splice($A,$m,$n,$B);
        sort($A);
        return $A;
    }
}

$s = new Solution();

$r = $s->merge([1,2,3,0,0,0],3,[2,5,6],3);
var_dump($r);