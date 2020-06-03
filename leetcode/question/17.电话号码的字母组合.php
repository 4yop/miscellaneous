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
        $queue = [[]];
        $res = [];
        $i= 0;
        while($i < $queue){
            $node = array_shift($queue);
            for($i = 0;$i<$len;$i++){
                if(!array_key_exists($digits[$i],$queue)){
                    foreach ($arr[$digits[$i]] as $k=>$v){
                        $temp = $node;
                        $temp[$digits[$i]] = $v;
                        $queue[] = ;
                    }

                }
            }
            $i++;
        }
        return $res;
    }


}

$so = new Solution();
$nums = "23";
$val = 3;
$res = $so->letterCombinations($nums);
print_r($res);