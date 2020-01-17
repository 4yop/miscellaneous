<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function hammingDistance($x, $y) {
        if($x == $y){
            return 0;
        }
        $x1 = decbin($x);
        $y1 = decbin($y);
        if($x > $y){
            $len = strlen($x1);
            $y1 = str_pad($y1,$len,0,STR_PAD_LEFT);
        }elseif($x < $y){
            $len = strlen($y1);
            $x1 = str_pad($x1,$len,0,STR_PAD_LEFT);
        }
        $res = 0;
        for($i = 0;$i < $len;$i++){
            if($x1[$i] != $y1[$i]){
                $res++;
            }
        }
        return $res;
    }

    

}

$s = new Solution();

$res = $s->hammingDistance(1,4);
var_dump($res);







