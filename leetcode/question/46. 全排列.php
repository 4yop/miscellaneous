<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
class Solution {
    //dfs
    function permute($nums){
        $count = count($nums);
        $res = [];

        $queue = array_map(function($val){
                    return [$val];
                 },$nums);
        while(!empty($queue)){
            $node = array_shift($queue);
            $temp = $node;
            foreach ($nums as $v){
                if(!in_array($v,$node)){
                    $temp[] = $v;
                    if(count($temp) == $count){
                        $res[] = $temp;
                    }else{
                        $queue[] = $temp;
                    }
                }
            }
        }
        return $res;
    }

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function permute1($nums) {
        $this->backtracking($nums,[]);
        return $this->res;
    }

    /**
     * @param $nums
     * @param $arr
     */
    function backtracking($nums,$arr){

        if(count($arr) == count($nums)){
            $this->res[] = $arr;
            return;
        }

        foreach ($nums as $value){
            if(!in_array($value,$arr)){
                $arr[] = $value;
                $this->backtracking($nums,$arr);
                array_pop($arr);
            }
        }

    }
}

$solution = new Solution();
$res = $solution->permute([1,2,3]);
print_r($res);