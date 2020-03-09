<?php
class Solution {

    function firstUniqChar($s) {
        if(empty($s)){
            return -1;
        }
        $arr = str_split($s);
        $hash = array_count_values($arr);
        foreach($arr as $k => $v){
            if($hash[$v] == 1){
                return $k;
            }
        }
        return -1;
    }
}

$s = new Solution();
