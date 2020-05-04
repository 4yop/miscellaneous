<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    //双指针
    function moveZeroes($nums) {
        $j = 0;
        $count = count($nums);
        for($i = 0;$i < $count;$i++){
            if($nums[$i] != 0){
                $nums[$j++] = $nums[$i];
            }
        }
        while($j < count($nums)){
            $nums[$j++] = 0;
        }
        return $nums;
    }

}

$s = (new Solution())->moveZeroes([0,1,0,3,12] );
var_dump($s);