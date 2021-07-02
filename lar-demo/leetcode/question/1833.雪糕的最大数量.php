<?php

class Solution {

    /**
     * @param Integer[] $costs
     * @param Integer $coins
     * @return Integer
     */
    //将最价格最低都买了，不就能买最多了么？
    //从小到大排序,前边的能买就买
    //时间复杂度 ：O(n)
    function maxIceCream($costs, $coins) {
        sort($costs);
        $count = 0;
        foreach ($costs as $cost)
        {
            if ($coins >= $cost)
            {
                $coins -= $cost;
                $count++;
            }else
            {
                break;
            }
        }
        return $count;
    }


}


$s = new Solution();


$costs = [1,6,3,1,2,5];

$coins = 20;

$r = $s->maxIceCream1($costs,$coins);

print_r($r);
