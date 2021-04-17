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
    function findMaxAverage($nums, $k) {
        $end = count($nums) - $k;
        $avg = array_sum(array_slice($nums,0,$k))/$k;
        for($i = 1;$i<=$end;$i++){
            $avg = max($avg,array_sum(array_slice($nums,$i,$k))/$k);

        }
        return $avg;
    }
}

$solution = new Solution();//bacdfeg


    $res = $solution->findMaxAverage([0,1,1,3,3], 4);
print_r($res);