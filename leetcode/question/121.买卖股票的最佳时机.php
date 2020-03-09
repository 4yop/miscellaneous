<?php
class Solution {

    /**
     * @param Integer[] $prices
     * @return Integer
     */
    function maxProfit($prices) {
        $res = 0;

        for($i = 0;$i < count($prices);$i++){
            for($j = $i + 1;$j < count($prices);$j++){
                $val = $prices[$j] - $prices[$i];
                if($val > $res){
                    $res = $val;
                }
            }
        }

        return  $res;
    }
}

$s = new Solution();
$r = $s->maxProfit([7,1,5,3,6,4]);
var_dump($r);