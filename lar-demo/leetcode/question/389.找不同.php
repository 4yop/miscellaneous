<?php
class Solution {

    /**时间复杂度 O(n)
     * 空间复杂读 O(1)
     * @param String $s
     * @param String $t
     * @return String
     */
    function findTheDifference($s, $t) {
        $s = array_sum(array_map('ord',str_split($s)));
        $t = array_sum(array_map('ord',str_split($t)));
        return chr($t- $s);
    }
}
$s = "abcd";
$t = "abcde";
$so = new Solution();

$r = $so->findTheDifference($s,$t);

var_dump($r);