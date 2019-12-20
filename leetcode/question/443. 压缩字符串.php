<?php
//443. 压缩字符串
class Solution {


    function compress($chars) {
        $i = 0;
        $end = count($chars);
        $jb = 0;
        while($i < $end){
            if($chars[$i+1] == $chars[$i]){
                $chars[$i+1] = 2;
                $jb = $i+1;
                $j = $i+2;
                while($chars[$j] == $chars[$i]){
                    unset($chars[$j]);
                    $chars[$jb]++;
                    $j++;
                }
                $i = $j;
            }else{
                $chars[$i+1] = 1;
                $i += 2;
            }
        }
        return $chars;
    }
}

$so = new Solution();
$res = $so->compress(["a","a","b","b","c","c","c"]);
print_r($res);