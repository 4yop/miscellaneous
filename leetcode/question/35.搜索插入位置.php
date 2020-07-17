<?php






class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    //暴力法
    function searchInsert($nums, $target) {
        foreach ($nums as $k => $v){
            if($v >= $target){
                return $k;
            }
        }
        return $k + 1;
    }

    //二分查找
    function searchInsert1($nums, $target) {

        while(){

        }

    }
}

$so = new Solution();

//1211
$res = $so->searchInsert(  [1,3,5,6],0);
print_r($res);