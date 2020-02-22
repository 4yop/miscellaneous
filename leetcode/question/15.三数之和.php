<?php






class Solution {


    function threeSum($nums) {

        sort($nums);
        $res = [];
        $len = count($nums);
        foreach($nums as $i=>$v){
            if($i ==0 || $v > $nums[$i-1]){
                $l = $i + 1;
                $r = $len - 1;
                while($l < $r){
                    $s = $v + $nums[$l] + $nums[$r];
                    if($s == 0){
                        $res[] = [$v,$nums[$l],$nums[$r]];
                        $l++;
                        $r--;
                        while ($l < $r && $nums[$l] == $nums[$l-1]){
                            $l++;
                        }
                        while ($l < $r && $nums[$r] == $nums[$r+1]){
                            $r--;
                        }
                    }elseif($s>0){
                        $r--;
                    }else{
                        $l++;
                    }
                }
            }
        }
        return $res;
    }
}

$so = new Solution();
$nums = [-1, 0, 1, 2, -1, -4];
$val = 3;
$res = $so->threeSum($nums);
print_r($res);