<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2020/1/17
 * Time: 11:21
 */

class Solution {

    /**
     * @param Integer $N
     * @return Integer
     */
    function majorityElement($nums) {
        $arr = array_count_values($nums);
        $len = count($nums)/3;
        foreach($arr as $k => $v){
            if($v > $len){
                $res[] = $k;
            }
        }
        return $res;
    }
}

$res = (new Solution())->majorityElement([3,2,3]);


var_dump($res);