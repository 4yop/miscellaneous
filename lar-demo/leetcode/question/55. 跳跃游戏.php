<?php
//55. 跳跃游戏





class Solution {


    function canJump($nums) {
        if(!in_array(0,$nums)){
            return true;
        }
        $queue = [ [0,$nums[0]]];
        $end = count($nums) - 1;
        while(!empty($queue)){
            list($key,$val) = array_shift($queue);
            if($key == $end){
                return true;
            }
            $max = min($end,$key+$val);
            for($i = $key + 1;$i<= $max;$i++){
                $queue[] = [$i,$nums[$i]];
            }
        }
        return false;
    }
}

$so = new Solution();
$nums = [3,2,1,0,4];
$res = $so->canJump($nums);
var_dump($res);