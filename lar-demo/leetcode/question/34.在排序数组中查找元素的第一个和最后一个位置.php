<?php






class Solution {


    function searchRange($nums, $target) {
        $left = 0;
        $right = count($nums) - 1;
        $start = -1;
        $end = -1;
        while($left <= $right && ($start == -1 || $end == -1)){
            if($nums[$left] != $target){
                $left++;
            }else{
                $start = $left;
            }
            if($nums[$right] != $target){
                $right--;
            }else{
                $end = $right;
            }
        }
        return [$start,$end];
    }
}

$so = new Solution();
$nums = array(2,2,3,3);
$val = 3;
$res = $so->searchRange( [5,7,7,8,8,10],6);
print_r($res);