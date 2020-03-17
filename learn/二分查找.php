<?php

class Solution{

    function search1($arr,$target){
        sort($arr);
        $count = count($arr);
        if($count == 0){
            return -1;
        }

        $left = 0;
        $right = $count - 1;
        while($left <= $right){
            $mid = (int)(($left + $right)/2);
            if($arr[$mid] == $target){
                return $mid;
            }elseif($arr[$mid] > $target){
                $right = $mid - 1;
            }else{
                $left = $mid + 1;
            }
        }
        return -1;
    }

    function serach2($arr,$target){

        $count = count($arr);
        if($count == 0){
            return -1;
        }
        $left = 0;
        $right = $count;
        while($left < $right){
            $mid = (int)($left + ($right - $left)/2);
            if($arr[$mid] == $target){
                return $mid;
            }elseif($arr[$mid] < $target){
                $left = $mid + 1;
            }else{
                $right = $mid;
            }
        }
        if($left != $count && $arr[$left] == $target){
            return $left;
        }
        return -1;
    }
}

$s = new Solution();
$r = $s->search1([1,2,3,4,5,6,7,8,9],7);
var_dump($r);