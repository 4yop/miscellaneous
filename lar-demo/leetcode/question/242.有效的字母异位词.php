<?php
class Solution {

    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isAnagram($s, $t) {
        return count_chars($s,1) ==count_chars($t,1);
    }
}

$so = new Solution();
$res = $so->isAnagram("anagram","nagaram");
var_dump($res);