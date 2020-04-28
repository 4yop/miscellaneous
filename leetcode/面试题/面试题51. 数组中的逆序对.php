<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function reversePairs($nums) {
        $res = 0;
        for($i = 0;$i < count($nums);$i++){
            $temp = $nums;
            $arr = array_count_values(array_splice($temp,$i+1));
            foreach($arr as $k => $v){
                if($nums[$i] > $k){
                    $res+=$v;
                }
            }
        }
        return $res;
    }
}

$s = new Solution();

$r = $s->reversePairs([7,5,6,4]);
var_dump($r);