<?php

class NumArray {
    /**
     * @param Integer[] $nums
     */
    public $nums = [];
    function __construct($nums) {
        $this->nums = $nums;
    }

    /**
     * @param Integer $i
     * @param Integer $j
     * @return Integer
     */
    function sumRange($i, $j) {
        $res = 0;
        while($i<=$j)
        {
            $res += $this->nums[$i++];
        }
        return $res;
    }
}

/**
 * Your NumArray object will be instantiated and called as such:
 * $obj = NumArray($nums);
 * $ret_1 = $obj->sumRange($i, $j);
 */