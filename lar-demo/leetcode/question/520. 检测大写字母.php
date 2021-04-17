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
    function detectCapitalUse($word) {
        return strtolower($word) == $word ||  strtoupper($word) == $word || ucwords(strtolower($word)) == $word ? true : false;
    }
}

$s = new Solution();
$res = $s->detectCapitalUse("usb");
var_dump($res);