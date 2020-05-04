<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function removeDuplicates($nums) {
        $m = 0;
        for($i=0;$i<count($nums);$i++){
            if($m<2 || $nums[$m-2]!=$nums[$i]){
                $nums[$m] = $nums[$i];
                $m++;
            }
        }
        return $nums;
    }

}

$solution = new Solution();//bacdfeg


    $res = $solution->removeDuplicates2( [1,1,1,2,2,2,3]);
    print_r($res);
