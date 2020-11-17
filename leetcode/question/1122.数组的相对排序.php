<?php

class Solution {

    /**
     * @param Integer[] $arr1
     * @param Integer[] $arr2
     * @return Integer[]
     */
    function relativeSortArray($arr1, $arr2) {
        $arr = array_count_values($arr1);

        $res = [];

        foreach ($arr2 as $v)
        {
            if (array_key_exists($v,$arr) )
            {
                for ($i = 0;$i < $arr[$v];$i++)
                {
                    $res[] = $v;
                }
            }
            else
            {
                $res[] = $v;
            }
        }
        return $res;
    }
}

$solition = new Solution();
$arr = [4,2,1,3];
$res = $solition->relativeSortArray($arr);
print_r($res);