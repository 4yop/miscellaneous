<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
//416. 分割等和子集
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function canPartition($nums) {
        $sum = array_sum($nums);
        //和不能除2就不能分成2份
        if($sum % 2 == 1){
            return false;
        }
        $avg = $sum / 2;
        //判断一半是否在数组，存在就删除它，再计算剩下的是否等于一半
        $key = array_search($avg,$nums);
        if($key !== false){
            unset($nums[$key]);
            return array_sum($nums) === $avg ? true : false;
        }


        $tempSum = 0;//一半的值
        $left = [];
        sort($nums);
        $len = count($nums);
        $i = 0;
        while($i < $len){
            $temp = $tempSum + $nums[$i];
            if($temp < $avg){
                $left[] = $nums[$i];
                $tempSum += $nums[$i];
                unset($nums[$i]);
            }elseif($temp == $avg){
                $left[] = $nums[$i];
                $tempSum += $nums[$i];
                unset($nums[$i]);
                break;
            }
            $i++;
        }
        print_r($left);print_r($nums);print_r($tempSum);
        return $tempSum === array_sum($nums) ? true : false;

    }
}

$solution = new Solution();
$res = $solution->canPartition([23,13,11,7,6,5,5]);
var_dump($res);