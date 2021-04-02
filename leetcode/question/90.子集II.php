<?php

class Solution {

    protected $result = [];
    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsetsWithDup($nums) {
        sort($nums);
        $this->sub($nums, [], 0);
        $this->result[] = [];
        return $this->result;
    }


    private function sub($nums, $list, $start)
    {
        if (count($list) == count($nums)) {
            return;
        }
        for ($i = $start; $i < count($nums); ++$i) {
            if (array_key_exists($i,$list))
            {
                continue;
            }
            $list[$i] = $nums[$i];
            $key = implode(',',$list);
            $this->result[$key] = $list;
            $this->sub($nums, $list, $i + 1);
            array_pop($list);
        }
    }
}
$nums = [0];

$s = new Solution();

$r = $s->subsetsWithDup($nums);

var_dump($r);