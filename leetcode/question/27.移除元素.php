<?php
//26. 删除排序数组中的重复项





class Solution {


    function removeElement($nums, $val) {
        $i = 0;
        $j = 0;
        while($i < count($nums)){
            if($nums[$i] != $val){
                $nums[$j] = $nums[$i];
            }
            $i++;
        }
        return $nums;
    }
}

$so = new Solution();
$nums = array(2,2,3,3);
$val = 3;
$res = $so->removeElement($nums,$val);
print_r($res);