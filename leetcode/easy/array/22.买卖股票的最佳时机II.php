<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function maxProfit($prices) {
        // 最大利润
        $maximum_profit = 0;

        for ($i = 0; $i < count($prices); $i++) {
            if ($i + 1 < count($prices) && $prices[$i + 1] > $prices[$i]) {
                $maximum_profit += $prices[$i + 1] - $prices[$i];
            }
        }

        return $maximum_profit;
    }
}

    $s = new Solution();
$res = $s->maxProfit([7,1,5,3,6,4]);
print_r($res);