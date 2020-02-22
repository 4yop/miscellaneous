<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function permute($nums) {
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
$res = $solution->permute([1,2]);
print_r($res);