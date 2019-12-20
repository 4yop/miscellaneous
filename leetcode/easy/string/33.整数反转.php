<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/20
 * Time: 16:14
 */
class Solution {

    /**
     * @param String[] $s
     * @return NULL
     */
    function reverse($x) {
        if(pow(-2,31) < $x || $x > (pow(2,31) -1)){
            return 0;
        }
        $n = $x >=0 ? $x : 0 - $x;
        $n = intval(strrev($n));
        return $x >=0 ? $n : '-'.$n;
    }
}

$s = new Solution();
$res = $s->reverse(1534236469);
print_r($res);