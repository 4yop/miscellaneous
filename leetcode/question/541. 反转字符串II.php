<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
//541. 反转字符串II
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function reverseStr($s, $k) {
        $len = strlen($s);
        $kk = 2*$k;
        for($i = 0;$i < $len;$i+=$kk){
            $left = substr($s,0,$i);
            $mid = strrev(substr($s,$i,$k));
            $right = substr($s,$i + $k);
            $s = $left.$mid.$right;
        }
        return $s;
    }
}

$solution = new Solution();//bacdfeg
$res = $solution->reverseStr("abcdef",3);
var_dump($res);