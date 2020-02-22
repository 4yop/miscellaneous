<?php






class Solution {

    public $res = [];
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

        $dig = array_map(function ($value) use ($arr){
            return $arr[$value];
        },str_split($digits));

        $this->helper($dig);

    }

    function helper($dig = [],$arr = []){



    }
}

$so = new Solution();
$nums = "23";
$val = 3;
$res = $so->letterCombinations($nums);
var_dump($res);