<?php
class Solution {

    /**
     * @param Integer[] $prices
     * @return Integer
     * O(n)
     * O(1)
     */
    function maxProfit($prices) {
        $min_price = max($prices);
        $max_profit = 0;
        foreach ($prices as $k=>$v) {
            if ($min_price > $v) {
                $min_price = $v;
            }elseif ($v - $min_price > $max_profit) {
                $max_profit = $v - $min_price;
            }
        }
        return $max_profit;
    }
}

$s = new Solution();
$r = $s->maxProfit([7,1,5,3,6,4]);
var_dump($r);