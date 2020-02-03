<?php






class Solution {


    function largestNumber($s) {
        $zero = [];
        for ($i = 0;$i < count($s);$i++){
            if(strpos($s[$i],'0') !== false){
                $zero[] = $s[$i];
                unset($s[$i]);
            }
        }
        rsort($zero,SORT_STRING);
        rsort($s,SORT_STRING);
        $res = implode('',$s).implode('',$zero);
        return $res;
    }
}

$so = new Solution();
$nums = [10,100];
$val = 3;
$res = $so->largestNumber($nums);
var_dump($res);