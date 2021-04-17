<?php
class Solution {

    /**
     * @param String[] $words
     * @return String[]
     */
    function findWords($words) {

        $hash = [
            'q' => 1,
            'w' => 1,
            'e' => 1,
            'r' => 1,
            't' => 1,
            'y' => 1,
            'u' => 1,
            'i' => 1,
            'o' => 1,
            'p' => 1,

            'a' => 2,
            's' => 2,
            'd' => 2,
            'f' => 2,
            'g' => 2,
            'h' => 2,
            'j' => 2,
            'k' => 2,
            'l' => 2,


            'z' => 3,
            'x' => 3,
            'c' => 3,
            'v' => 3,
            'b' => 3,
            'n' => 3,
            'm' => 3,

        ];
        $res = [];

        foreach ($words as $v){
            $temp = $hash[strtolower($v[0])];
            $strlen = strlen($v);
            $flag = true;
            for($i = 1;$i < $strlen;$i++){
                if($temp != $hash[strtolower($v[$i])]){
                    $flag = false;
                    break;
                }
            }
            if($flag){
                $res[] = $v;
            }
        }
        return $res;
    }
}

$s = new Solution();
$r = $s->findWords(["Hello", "Alaska", "Dad", "Peace"]);
var_dump($r);