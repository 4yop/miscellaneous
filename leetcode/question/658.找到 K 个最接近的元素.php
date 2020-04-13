<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/2
 * Time: 9:59
 */
class Solution {

    /**
     * @param Integer[] $arr
     * @param Integer $k
     * @param Integer $x
     * @return Integer[]
     */
    function findClosestElements($arr, $k, $x) {
        $key = 0;
        $value = PHP_INT_MAX;


        foreach ($arr as $k1 => $v){
            if(abs($v - $x) < abs($value - $x)){
                $value = $v;
                $key = $k1;
                if($v == $x){
                    break;
                }
            }
        }


        $left = $key;
        $right = $key;
        while($right - $left != $k){
            if($x - $arr[$left] < $arr[$right] - $x || $right == count($arr)){
                $left--;
            }else{
                $right++;
            }
        }

        return array_splice($arr,$left,$k);
    }
}

$r = (new Solution())->findClosestElements([1,2,3,4,5],
4,
-1);
var_dump($r);//1,2,3,4




