<?php
//26. 删除排序数组中的重复项





class Solution {


    function removeDuplicates($nums) {
//        $len = count($nums);
//        for($i=1;$i<$len;$i++){
//            if($nums[$i] == $nums[$i-1]){
//                unset($nums[$i-1]);
//            }
//        }

        $i = 0;
        $j = count($nums) - 1;

        while($i <= $j){
            echo "i:$i,j:$j\n";
            if($nums[$i] == $nums[$i+1]){
                unset($nums[$i]);
            }
            if($nums[$j] == $nums[$j-1]){
                unset($nums[$j]);
            }
            $i++;
            $j--;
        }

        return count($nums);
    }
}

$so = new Solution();
$res = $so->removeDuplicates([1,1,1,1]);
print_r($res);