<?php






class Solution {


    function letterCombinations($digits) {
        $arr =[
            2 => ['a','b','c'],
            3 => ['d','e','f'],
            4 => ['g','h','i'],
            5 => ['j','k','l'],
            6 => ['m','n','o'],
            7 => ['p','q','r','s'],
            8 => ['a','b','c'],
            9 => ['w','x','y','z'],
        ];

        $len = strlen($digits);
        $res = [];





        return $res;
    }


}

$so = new Solution();
$nums = "23";
$val = 3;
$res = $so->letterCombinations($nums);
print_r($res);