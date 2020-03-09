<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2020/1/17
 * Time: 11:21
 */

class Solution {


    function rotate($nums, $k) {
        $count = count($nums);
        $end = $count - ($k % $count) ;

        return array_merge(array_splice($nums,$end),array_splice($nums,0,$end));
    }
}

$res = (new Solution())->rotate([1,2,3,4,5,6,7],3);


var_dump($res);