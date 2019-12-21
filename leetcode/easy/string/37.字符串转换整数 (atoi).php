<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/20
 * Time: 16:14
 */
class Solution {


    function myAtoi($str) {
        $str = intval(trim(str_replace('e','x',$str)));

        if(is_numeric($str)){
            if($str < -2147483648){
                return -2147483648;
            }
            if($str >= 2147483648){
                return 2147483647;
            }
            return $str;
        }
        return 0;
    }
}


$s = new Solution();
$res = $s->myAtoi("   -115579378e25");
print_r($res);
echo "\n";