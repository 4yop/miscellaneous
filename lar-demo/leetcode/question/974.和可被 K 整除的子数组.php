<?php

class Solution {

    function subarraysDivByK($A, $K) {
        $count = count($A);
        $res = 0;
        for($i = 0;$i < $count;$i++){
            $sum = 0;
            for($j = $i;$j<$count;$j++){
                $sum += $A[$j];
                if($K == $sum || $sum % $K == 0){
                    $res++;
                }
            }
        }
        return $res;
    }
}

$res = (new Solution())->subarraysDivByK([4,5,0,-2,-3,1],5);
print_r($res);