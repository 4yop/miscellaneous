<?php






class Solution {


    function longestPalindrome($s) {
        $strlen = strlen($s);
        $res = '';
        $j = $strlen;
        while($j >= 1){
            for ($i = 0;$i < $strlen;$i++){
                $str = substr($s,$i,$j);
                if($this->isPalindrome($str) && strlen($str) > strlen($res) ){
                    $res = $str;
                }
            }
            $j--;
        }
        return $res;

    }
    //是否为回文字符串
    function isPalindrome($str){

        $strlen = strlen($str);
        $half = floor($strlen/2);
        if($strlen % 2 == 0){
            $rStart = $half;
        }else{
            $rStart = $half + 1;
        }
        $left = substr($str,0,$half);
        $right = substr($str,$rStart,$half);
        return strrev($left) == $right ? true : false;
    }
}

$so = new Solution();
$nums = "ababa";
$val = 3;
$res = $so->longestPalindrome($nums);
var_dump($res);