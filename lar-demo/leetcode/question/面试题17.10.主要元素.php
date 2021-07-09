<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    /**
     * 投票算法
     * 时间复杂度：O(n)
     * 空间复杂度：O(1)
     */
    function majorityElement($nums) {
        $n = -1;
        $count = 0;
        foreach ($nums as $num)
        {
            if ($count == 0)
            {
                $n = $num;

            }
            if ($n !== $num)
            {
                $count--;
            }else
            {
                $count++;
            }
        }

        $count = 0;
        foreach($nums as $v)
        {
            if ($v == $n)
            {
                $count++;
            }
        }
        return $count > count($nums)/2 ? $n : -1;
    }
}
