<?php
class Solution {

    /**
     * @param String $S
     * @return String
     */
    function compressString($S) {
        $strlen = strlen($S);
        $res = $S[0];
        $num = 1;
        $str = $S[0];
        for($i = 1;$i < $strlen;$i++){
            if($S[$i] == $str){
                $num++;
            }else{
                $str = $S[$i];
                $res .= $num.$str;
                $num = 1;
            }
        }
        $res .= $num;

        return strlen($res) < $strlen ? $res : $S;
    }
}

$s = new Solution();

$r = $s->compressString("aabcccccaaa");
var_dump($r);