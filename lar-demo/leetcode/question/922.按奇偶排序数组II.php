<?php

class Solution {

    /**
     * @param Integer[] $A
     * @return Integer[]
     * O(N)
     * O(1)
     */
    function sortArrayByParityII($A) {
        $j = 1;
        $count = count($A);
        for ($i = 0;$i < $count;$i+=2)
        {
            if ($A[$i]%2 == 1)
            {
                while ($A[$j]%2 == 1)
                {
                    $j += 2;
                }
                $temp = $A[$i];
                $A[$i] = $A[$j];
                $A[$j] = $temp;
            }
        }
        return $A;
    }
}