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
        $strlen = strlen($n);
        if($strlen < 2 || $this->hash[$n] > 0){
            return false;
        }

        $this->hash[$n] = 1;
        $sum = 0;echo $n[0];
        for ($i = 0;$i < $strlen;$i++){
            echo $n[$i];exit;
            $sum += ($n[$i]*$n[$i]);
        }

        if($sum == 1){
            return true;
        }
//        else{
//            return $this->isHappy2($sum);
//        }
    }

}

$so = new Solution();
$res = $so->isHappy2(19);
var_dump($res);