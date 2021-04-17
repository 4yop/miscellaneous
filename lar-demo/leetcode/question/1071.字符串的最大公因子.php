<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2020/1/2
 * Time: 14:31
 */

class Solution {

    function gcdOfStrings($str1, $str2) {

        $strlen1 = strlen($str1);
        $strlen2 = strlen($str2);

        for($len = $strlen2;$len > 0;$len--){
            if($strlen2 % $len != 0 || $strlen1 % $len != 0){
                continue;
            }
            for($start = 0; $strlen2 - $len >= $start;$start++){
                $str = substr($str2,$start,$len);
                if(substr_count($str1,$str) == ($strlen1/$len) && substr_count($str2,$str) == ($strlen2/$len)){
                    return $str;
                }

            }
        }
        return '';
    }
}

$res = (new Solution())->gcdOfStrings('ABABAB', 'ABAB');
var_dump($res);