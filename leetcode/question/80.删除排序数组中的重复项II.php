<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
//44.通配符匹配
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function removeDuplicates($nums) {
        $end = count($nums) - 2;
        for($i = 0;$i<=$end;$i++){
            if($nums[$i] == $nums[$i+1] && $nums[$i] == $nums[$i+2]){
                unset($nums[$i]);
            }
        }
        return $nums;
    }
}

$solution = new Solution();//bacdfeg


    $res = $solution->removeDuplicates( [1,1,1,2,2,3]);
    print_r($res);
