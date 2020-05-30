<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
class Solution {

    function subsets($nums) {
        $queue = [[]];
        $i = 0;
        foreach ($nums as $v){
            while($i < count($queue)){
                $temp1 = $queue[$i];
                $temp2 = $queue[$i];
                $i++;
            }
        }
    }
}

$solution = new Solution();
$res = $solution->subsets([1,2,3]);
print_r($res);