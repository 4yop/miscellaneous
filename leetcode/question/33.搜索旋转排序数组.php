<?php






class Solution {


    function search($nums, $target) {
        $count = count($nums);
        if(count($nums) == 0){
            return -1;
        }
        //找到最小值的开头
        $point = 0;
        for($i = 1;$i < $count;$i++){
            if($nums[$i] < $nums[$i-1]){
                $point = $i;
                break;
            }
        }
        if($point == 0){
            $left = 0;
            $right = $count - 1;
        }elseif($target == $nums[0]){
            return 0;
        }elseif($target > $nums[0]){
            $left = 0;
            $right = $point -1;
        }else{
            $left = $point -1;
            $right = $count - 1;
        }
//        print_r(compact('left','right','point'));exit;
        while($left <= $right){
            $mid = (int)( ($left + $right)/2 );
            if($target == $nums[$mid]){
                return $mid;
            }elseif($target > $nums[$mid]){
                $left = $mid + 1;
            }else{
                $right = $mid - 1;
            }
        }
        return -1;
    }
}

$so = new Solution();
$nums = array(2,2,3,3);
$val = 3;
$res = $so->search([3,1],1);
print_r($res);