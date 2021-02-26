<?php








class Solution {

    /**
     * @param Integer[][] $A
     * @return Integer[][]
     */
    function flipAndInvertImage($A) {
        foreach ($A as &$v)
        {
            $i = 0;
            $j = count($v) - 1;
            while ($i < $j)
            {
                $temp = $v[$i];
                $v[$i] = ($v[$j] == 1 ? 0 : 1);
                $v[$j] = ($temp == 1 ? 0 : 1);
                $i++;
                $j--;
            }
            if ($j == $i)
            {
                $v[$i] = ($v[$i] == 1 ? 0 : 1);
            }
        }
        return $A;
    }



}



$so = new Solution();

$res = $so->flipAndInvertImage([[1,1,0],[1,0,1],[0,0,0]]);
var_dump($res);