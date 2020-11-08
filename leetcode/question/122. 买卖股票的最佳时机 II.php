<?php
class Solution {

    /**
     * @param Integer[] $prices
     * @return Integer
     * O(n)
     * O(1)
     */
    function maxProfit($prices) {
        $max_profit = 0;
        for ($i = 1;$i < count($prices);$i++)
        {
            if ($prices[$i] > $prices[$i-1])
            {
                $max_profit += ($prices[$i] - $prices[$i-1]);
            }
        }
        return $max_profit;
    }
}

$s = new Solution();
$r = $s->maxProfit([7,1,5,3,6,4]);
var_dump($r);