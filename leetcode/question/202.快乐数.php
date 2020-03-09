<?php
//202.快乐数
class Solution {


    function isHappy($n) {


        $log = [];
        while($log[$n] < 2){
            $sum = 0;
            $n = str_split($n);
            for($i = 0;$i<count($n);$i++){
                $sum += $n[$i] * $n[$i];
            }

            if($sum === 1){
                return true;
            }else{
                $n = $sum;
                $log[$sum]++;
            }
        }
        return false;
    }
}

$so = new Solution();
$res = $so->isHappy(19);
var_dump($res);