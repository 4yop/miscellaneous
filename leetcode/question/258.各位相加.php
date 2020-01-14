<?php
//258. 各位相加
class Solution {

    /**
     * @param Integer $num
     * @return Integer
     */
    function addDigits($num) {
        while($num >= 10){
            $num = array_sum(str_split($num));
        }
        return $num;
    }
}

$so = new Solution();
$res = $so->addDigits(38);
print_r($res);