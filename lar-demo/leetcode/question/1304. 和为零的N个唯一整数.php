<?php

class Solution {

    /**
     * @param Integer $n
     * @return Integer[]
     */
    function sumZero($n) {
        if($n % 2 == 0){
            $max = $n/2;
            $min = "-$max";
            return array_filter(range($min,$max));
        }else{

            $max = ($n-1)/2;
            $min = "-$max";

            return range($min,$max);
        }
    }
}

$res = (new Solution())->sumZero(6);
print_r($res);