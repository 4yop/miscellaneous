<?php






class Solution {


    function lengthOfLongestSubstring($s) {

        $len = strlen($s);

        $str = '';
        $count = 0;
        for($i =0;$i<$len;$i++){
            $index = strpos($str,$s[$i]);
            if($index !== false){
                $str = substr($str,$index+1);
            }
            $str .= $s[$i];
            $count = strlen($str) > $count ? strlen($str) : $count;
        }
        return $count;

    }
}

$so = new Solution();
$nums = "dvdf";
$val = 3;
$res = $so->lengthOfLongestSubstring($nums);
print_r($res);