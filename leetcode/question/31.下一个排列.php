<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     * 两遍扫描
     * O(N)
     * O(1)
     */
    function nextPermutation(&$nums)
    {
        $i = count($nums) - 2;
        while ($i >= 0 && $nums[$i] >= $nums[$i+1])
        {
            $i--;
        }

        if ($i >= 0) {
            $j = count($nums) - 1;
            while ($j > $i && $nums[$i] >= $nums[$j])
            {
                $j--;
            }
            //到后面的比前面的大就停止..
            $this->swap($nums,$i,$j);
        }

        $this->reverse($nums,$i+1);
    }

    function swap(&$nums,$i,$j)
    {
        $temp = $nums[$i];
        $nums[$i] = $nums[$j];
        $nums[$j] = $temp;
    }

    function reverse(&$nums,$start)
    {
        $left = $start;
        $right = count($nums) - 1;
        while ($left < $right)
        {
            $this->swap($nums,$left,$right);
            $left++;
            $right--;
        }
    }
}

$so = new Solution();
$nums = [1,2];
$r = $so->nextPermutation($nums);

var_dump($nums);