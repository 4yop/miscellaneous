<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function subarraySum($nums, $k) {
        $res = 0;
        $count = count($nums);
        foreach($nums as $key=>$value){
            $len = 1;
            while($count >= $len + $key){
                $temp = $nums;
                $arr =array_splice($temp,$key, $len);print_r($arr);
                $sum = array_sum($arr);
                if($sum == $k){
                    $res++;
                }elseif($sum > $k){
                    break;
                }
                $len++;
            }
        }
        return $res;
    }
}

$s = new Solution();

$r = $s->subarraySum([1,2,3],3);

var_dump($r);