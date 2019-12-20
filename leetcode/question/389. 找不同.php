<?php
//389. 找不同
class Solution {


    function findTheDifference($s, $t) {
//        $s = str_split($s);
//        $t = str_split($t);


        return current(array_diff_assoc(str_split($t),str_split($s)));
    }
}

$s = "a";
$t = "aa";
$so = new Solution();
$res = $so->findTheDifference($s,$t);
var_dump($res);