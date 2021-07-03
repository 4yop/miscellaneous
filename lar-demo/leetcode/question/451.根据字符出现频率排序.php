<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/18
 * Time: 16:34
 */
class Solution {

    /**
     * @param String $word
     * @return Boolean
     */
    //直接使用php 自带的函数
    function frequencySort($s) {
        $arr = array_count_values(str_split($s));
        arsort($arr);
        $res = '';
        foreach ($arr as $str=>$len)
        {
            $res .= str_repeat($str,$len);
        }
        return $res;
    }



    function frequencySort1($s) {

    }

}

$s = new Solution();
$res = $s->frequencySort('cccaaa');
var_dump($res);
