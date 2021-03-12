<?php






class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function calculate($s) {
        $s = trim($s);

    }
}

$so = new Solution();
$nums = " 3+5 / 2 ";

$res = $so->calculate($nums);
print_r($res);