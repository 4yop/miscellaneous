<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function rob($nums) {
        if(empty($nums)){
            return 0;
        }
        if(count($nums) == 1){
            return $nums[0];
        }
        $dp[0] = $nums[0];
        $dp[1] = max($dp[0] , $nums[1]);
        for($i = 2;$i < count($nums);$i++){
            $dp[$i] = max($dp[$i-1],$dp[$i-2]+$nums[$i]);
        }
        return $dp;
    }



}

$s = new Solution();

$res = $s->rob([2,7,9,3,1]);
var_dump($res);







