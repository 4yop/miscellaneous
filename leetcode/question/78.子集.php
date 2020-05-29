<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
class Solution {

    function subsets($nums) {
        $queue = array_map(function($val){
                    return [$val];
                 },$nums);

        for($i = 0;$i < count($queue);$i++){
            $temp = $queue[$i];
            foreach ($nums as $v){
                if(!in_array($v,$queue[$i]) && $v > max($queue[$i])){
                    $temp[] = $v;
                    $queue[] = $temp;
                }
            }
        }
        $queue[] = [];
        return $queue;
    }
}

$solution = new Solution();
$res = $solution->subsets([1,2,3]);
print_r($res);