<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
class Solution {


    function myPow($x, $n) {
        if($n < 0){
            $x = 1/$x;
            $n = -$n;
        }
        $res = 1;
        for ($i = 0;$i < $n;$i++){
            $res = $res * $x;
        }
        return $res;
    }


}

$solution = new Solution();
$res = $solution->myPow(4,5);
print_r($res);