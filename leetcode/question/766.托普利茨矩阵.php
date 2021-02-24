<?php


class Solution {


    /**
     * @param Integer[][] $matrix
     * @return Boolean
     */
    function isToeplitzMatrix($matrix)
    {

        foreach ($matrix[0] as $k=>$v)
        {
            $j = $k;
            while (isset($matrix[$i+1][$j+1]))
            {
                if ($matrix[$i+1][$j+1] != $v)
                {
                    return false;
                }
                $i++;
                $j++;
            }
        }

        $i = 0;
        foreach ($matrix as $k=> $value)
        {
            $v = $value[0];
            $j = $k;
            while (isset($matrix[$i+1][$j+1]))
            {
                if ($matrix[$i+1][$j+1] != $v)
                {
                    return false;
                }
                $i++;
                $j++;
            }
        }
        return true;
    }

}






$solution = new Solution();
$matrix = [[1,2,3,4],[5,1,2,3],[9,5,1,2]];
$res = $solution->isToeplitzMatrix($matrix);

var_dump($res);