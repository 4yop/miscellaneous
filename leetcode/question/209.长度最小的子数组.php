<?php






class Solution {


    function minSubArrayLen($s, $nums) {
        $len = count($nums);
        $sum = array_sum($nums);
        if($sum < $s){
            return 0;
        }else if($sum == $s){
            return $len;
        }
        $res = $len;

        foreach ($nums as $k=>$v){
            $sum = 0;
            for($i = $k; $i < $len;$i++){
                $sum += $nums[$i];
                if($sum >= $s){
                    $res = min($res,$i-$k+1);
                    break;
                }
            }
        }
        return $res;
    }

}

$so = new Solution();
$s = 7; $nums = [2,3,1,2,4,3];

$res = $so->minSubArrayLen($s, $nums);
print_r($res);