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

    //递归
    public $hash = [];
    function isHappy2($n){
        if($n == 1){
            return true;
        }
        $strlen = strlen($n);
        if(isset($this->hash[$n]) || $n == 4 ){
            return false;
        }
        $this->hash[$n] = 1;
        $sum = 0;
        $n = (string)$n;
        for ($i = 0;$i < $strlen;$i++){
            $sum += ($n[$i]*$n[$i]);
        }
        return $this->isHappy2($sum);

    }



}

$so = new Solution();
$res = $so->isHappy2(19);
var_dump($res);