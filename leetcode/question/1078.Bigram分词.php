<?php






class Solution {

    //暴力法
    function findOcurrences($text, $first, $second) {
        if (empty($text)) {
            return [];
        }
        $arr = explode(' ', $text);
        $count = count($arr);
        $out = [];
        for ($i=0;$i<$count;$i++) {
            if (empty($arr[$i])) {
                continue;
            }
            if ($i==$count - 1) {
                break;
            }
            if ($arr[$i] == $first && $arr[$i+1] == $second && isset($arr[$i+2])) {
                $out[] = $arr[$i+2];
            }
        }
        return $out;
    }
}

$so = new Solution();
$nums = [10,100];
$val = 3;
$res = $so->findOcurrences("alice is a good girl she is a good student","a","good");
var_dump($res);