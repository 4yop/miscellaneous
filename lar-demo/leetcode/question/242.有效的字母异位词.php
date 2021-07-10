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

    function isAnagram1($s, $t) {
        if (strlen($s) != strlen($t))
        {
            return false;
        }
        $s = str_split($s);
        $t = str_split($t);
        sort($s);
        sort($t);
        return implode('',$s) == implode('',$t);
    }
}

$so = new Solution();
$res = $so->isAnagram("anagram","nagaram");
var_dump($res);
