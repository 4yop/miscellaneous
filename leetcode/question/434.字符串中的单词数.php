<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
//984. 不含 AAA 或 BBB 的字符串
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function countSegments($s) {
        return !empty($s) ? count(array_filter(explode(' ',$s))) : 0;
    }
}


    $solution = new Solution();
    $res = $solution->countSegments("Hello, my name is John");
    var_dump($res);

