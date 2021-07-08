<?php


class Solution {

    //暴力法
    //时间复杂度：O(N²)
    //空间复杂度:O(1)
    function twoSum1($nums, $target) {
        $count = count($nums);
        for ($i = 0;$i < $count;$i++)
        {
            for ($j = $i + 1;$j < $count;$j++)
            {
                if ($nums[$i] + $nums[$j] === $target)
                {
                    return [$i,$j];
                }
            }
        }
    }

    //hash map 保存
    //时间复杂度：O(N)
    //空间复杂度:O(N)
    function twoSum($nums, $target) {
        $map = [];
        foreach ($nums as $k => $v)
        {
            $num = $target - $v;
            if (isset($map[$num]))
            {
                return [$k,$map[$num]];
            }
            $map[$v] = $k;
        }
    }
}
