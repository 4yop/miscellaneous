<?php






class Solution {

    //加标志
    //时间复杂度 O(mn)
    //空间复杂度 O(m+n)
    function setZeroes(&$matrix) {
        $row = array_fill(0,count($matrix),false);
        $col = array_fill(0,count($matrix[0]),false);
        foreach ($matrix as $key=>$value)
        {
            foreach ($value as $k=>$v)
            {
                if ($v == 0)
                {
                    $row[$key] = true;
                    $col[$k] = true;
                }
            }
        }
        foreach ($matrix as $key=>&$value)
        {
            foreach ($value as $k=>&$v)
            {
                if ($row[$key] || $col[$k])
                {
                    $v = 0;
                }
            }
        }

    }
}

$so = new Solution();
$nums = [
    [0,1,2,0],
    [3,4,5,2],
    [1,3,1,5]
];
$val = 3;
$res = $so->setZeroes($nums);
print_r($res);
