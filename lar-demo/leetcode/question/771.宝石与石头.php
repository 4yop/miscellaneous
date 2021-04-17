<?php


class Solution {


    function numJewelsInStones($J, $S) {
        if(empty($J)) return 0;
        $hash = array_flip(str_split($J));
        $res = 0;
        $strlen = strlen($S);
        for($i = 0;$i < $strlen;$i++){
            if(array_key_exists($S[$i],$hash)){
                $res++;
                while($S[$i + 1] == $S[$i] && $i < $strlen){
                    $i++;
                    $res++;
                }
            }
        }
        return $res;
    }


    function  f1($J, $S) {
        if(empty($J)) return 0;

        $res = 0;
        $strlen = strlen($J);
        for($i = 0;$i < $strlen;$i++){
            $res += substr_count($S,$J[$i]);
        }
        return $res;
    }

}






$solution = new Solution();

$res = $solution->numJewelsInStones("aA","aAAbbbb");
print_r($res);