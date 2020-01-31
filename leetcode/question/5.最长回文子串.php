<?php






class Solution {


    function longestPalindrome($s) {
        if(strlen($s) == 0){
            return '';
        }
        $start = 0;
        $end = 0;

        for($i = 0;$i < strlen($s);$i++){
            $len1 = $this->expandAroundCenter($s,$i,$i);
            $len2 = $this->expandAroundCenter($s,$i,$i+1);
            $len = max($len1,$len2);
            if($len > $end -$start){
                $start = $i - ($len - 1)/2;
                $end = $i + $len/2;
            }
        }
        return substr($s,$start,$end);
    }
    //是否为回文字符串
    function expandAroundCenter($s,$left,$right){

        while($left >= 0 && $right < strlen($s) && $s[$left] == $s[$right]){
            $left--;
            $right++;
        }
        return $right - $left - 1;
    }
}

$so = new Solution();
$nums = "aabaabaa";
$val = 3;
$res = $so->longestPalindrome($nums);
var_dump($res);