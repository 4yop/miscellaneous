<?php








class Solution {

    /**
     * @param String $s
     * @return String
     */
    function longestPalindrome($s) {
        $strlen = strlen($s);

        if($strlen < 1){
            return '';
        }

        $left = 0;//回文左边的键
        $right = 0;//回文右边的键

        for($i = 0;$i < $strlen;$i++){
            $len1 = $this->getPalindromeLength($s,$i,$i);
            $len2 = $this->getPalindromeLength($s,$i,$i+1);
            $len = max($len1,$len2);
            if($len > $right - $left){
                //根据回文长度 开始结束点与当前点的关系
                $left = $i - floor( ($len - 1) /2 );
                $right = $i + floor($len /2);
            }
        }

        return substr($s,$left,$right - $left + 1);

    }

    //根据 中心 获取回文长度
    function getPalindromeLength($s,$L,$R){
        while($s[$L] ==  $s[$R] && strlen($s) > $R && $L >= 0){
            $L--;
            $R++;
        }
        return $R - $L - 1;
    }
}



$so = new Solution();
$nums = "1a4baa2";
$val = 3;
$res = $so->longestPalindrome($nums);
var_dump($res);