<?php
//202.快乐数
class Solution {


    function isHappy($num) {
        $log = [];
        while($num != 1 || in_array($num,$log)){

            $log[] = $num;

            $arr = str_split($num);
            $num = 0;
            foreach ($arr as $v){
                $num += pow($v,2);
            }
        }
        //return $num;
        return $num == 1 ? true : false;
    }
}

$so = new Solution();
$res = $so->isHappy(19);
print_r($res);