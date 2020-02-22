<?php
//443. 压缩字符串
class Solution {


    function reachNumber($target) {
        $end = 0;
        $i = 0;
        while($end < $target){

            $end += (++$i);
        }
        return $i;
    }
}

$so = new Solution();
$res = $so->reachNumber(3);
var_dump($res);