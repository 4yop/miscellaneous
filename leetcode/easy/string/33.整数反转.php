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

        $n = $x >=0 ? $x : 0 - $x;
        $n = intval(strrev($n));

        if(-2147483648 >= $n || $n >= 2147483647){
            return 0;
        }

        return $x >=0 ? $n : '-'.$n;
    }
}

$s = new Solution();
$res = $s->reverse(1534236469);
print_r($res);