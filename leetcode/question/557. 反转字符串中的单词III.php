<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
//557. 反转字符串中的单词 III
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function reverseWords($s) {
        $arr = explode(' ',$s);
        $arr = array_map('strrev',explode(' ',$s));

        return implode(' ',array_map('strrev',explode(' ',$s)));
    }
}

$solution = new Solution();//bacdfeg
$s = "Let's take LeetCode contest";
$res = $solution->reverseWords($s);
var_dump($res);