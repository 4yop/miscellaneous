<?php
class Solution {

    /**
     * @param String $pattern
     * @param String $str
     * @return Boolean
     */
    function findDuplicate($pattern, $str) {

        $arr = explode(' ',$str);
        $strlen = strlen($pattern);
        if($strlen!= count($arr)){
            return false;
        }
        $hash = [];
        for($i = 0;$i < $strlen;$i++){

            if(!array_key_exists($pattern[$i].'-',$hash)){
                $hash[$pattern[$i].'-'] = $arr[$i];
            }elseif($hash[$pattern[$i].'-'] != $arr[$i]){
                return false;
            }
            if(!array_key_exists($arr[$i],$hash)){
                $hash[$arr[$i]] = $pattern[$i].'-';
            }elseif($hash[$arr[$i]] != $pattern[$i].'-'){
                return false;
            }
        }
        return true;
    }
}

$s = (new Solution())->findDuplicate("abc",
"b c a");
var_dump($s);