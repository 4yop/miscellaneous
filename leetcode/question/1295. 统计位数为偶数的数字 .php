<?php





class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function findNumbers($nums) {
        $res = 0;
        foreach($nums as $v){
            if(strlen($v)%2 == 0){
                $res++;
            }
        }
        return $res;
    }
}