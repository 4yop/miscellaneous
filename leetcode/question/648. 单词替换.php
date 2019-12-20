<?php
//648. 单词替换

class Solution {


    function replaceWords($dict, $sentence) {
        $arr = explode(' ',$sentence);
        foreach ($arr as $k=>$v){
            foreach ($dict as $kk => $vv){
                if($v[0] == $vv[0] && strpos($v,$vv) === 0){
                    $arr[$k] = str_replace($v,$vv,$v);
                    break;
                }
            }
        }
        return implode(' ',$arr);
    }
}




$dict = ["cat", "bat", "rat"];
$sentence = "the cattle was rattled by the battery";

$solution = new Solution();

$res = $solution->replaceWords($dict, $sentence);
print_r($res);