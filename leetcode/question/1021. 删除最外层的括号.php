<?php
//1021. 删除最外层的括号






class Solution {


    function removeOuterParentheses($S) {

        $out = "";//外层括号
        $in = "";//内层括号
        for ($i=0;$i < strlen($S); $i++){

            if($S[$i] == '(' && $out == ''){
                echo 1;
                $out .= $S[$i];
            }elseif (substr($in,-1) != '(' && substr($out,-1) == '(' && $S[$i] == ')'){
                echo 1;
                $out = str_replace('(','',$out);
            }else{
                echo 0;
                $in .= $S[$i];
            }


        }

        //return $in;
    }
}




$S = "((()())(()()))";

$solution = new Solution();

$res = $solution->removeOuterParentheses($S);
print_r($res);