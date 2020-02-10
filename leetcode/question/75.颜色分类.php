<?php






class Solution {


    function sortColors(&$nums) {
        //桶排序
        $bucket = [
            0 => 0,
            1 => 0,
            2 => 0,
        ];
        foreach ($nums as $v){
            $bucket[$v]++;
        }

        $res = [];
        foreach ($bucket as $k => $v){
            for($i = 0;$i<$v;$i++){
                $res[] = $k;
            }
        }
        return $res;
    }
}

$so = new Solution();
$nums = [2,0,2,1,1,0];
$val = 3;
$res = $so->sortColors($nums);
print_r($res);