<?php






class Solution {


    function wiggleSort(&$nums) {
        sort($nums);
        $len = count($nums);
        $mid = ceil($len/2);
        $left = array_slice($nums,0,$mid);
        $right = array_slice($nums,$mid);

        $res = [];

        while(!empty($left) && !empty($right)){
            if(!empty($left)){
                $res[] = array_shift($left);
            }

            if(!empty($right)){
                $res[] = array_shift($right);
            }


        }
        return $res;
    }
}

$so = new Solution();
$nums = [1, 5, 1, 1, 6, 4];
$val = 3;
$res = $so->wiggleSort($nums);
var_dump($res);