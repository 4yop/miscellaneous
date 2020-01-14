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
    function frequencySort($s) {
        $arr = array_count_values(str_split($s));
        arsort($arr);
        $res = '';
        foreach ($arr as $k => $v){
            for($i = 0;$i< $v;$i++){
                $res.=$k;
            }
        }
        return $res;
    }
}

$s = new Solution();
$res = $s->frequencySort('cccaaa');
var_dump($res);