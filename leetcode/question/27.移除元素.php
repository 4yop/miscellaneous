<?php
//26. 删除排序数组中的重复项





class Solution {


    function removeElement($nums, $val) {
        $i = 0;
        $j = key(end($nums));
        while($i < $j){
            if($nums[$i] == $val){
                unset($nums);
            }
            if($nums[$j] == $val){
                unset($nums);
            }
            $i++;
            $j--;
        }
        return count($nums);
    }
}

$so = new Solution();
$nums = array(2,2,3,3);
$val = 3;
$res = $so->removeElement($nums,$val);
print_r($res);