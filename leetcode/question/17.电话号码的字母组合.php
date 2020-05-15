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
        $queue = array_map(function($val){return [$val];},$arr[$digits[0]]);
        $res = [];

        while(!empty($queue)){
            $node = array_shift($queue);
            $start = count($node);

            for ($i = $start;$i<$len;$i++){
                foreach ($arr[$i] as $v){
                    if(!in_array($v,$node)){
                        $temp = $node;
                        $temp[] = $v;
                        if(count($temp) == $len){
                            $res[] = $temp;
                        }else{
                            $queue[] = $temp;
                        }

                    }
                }
            }
        }
        return $res;
    }


}

$so = new Solution();
$nums = "23";
$val = 3;
$res = $so->letterCombinations($nums);
var_dump($res);