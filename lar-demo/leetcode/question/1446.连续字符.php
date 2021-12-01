<?php
class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    //时间复杂度O(n)
    //空间复杂度O(1)
    function maxPower($s) {
        $res = $count = 1;

        for ($i = 1;$i < strlen($s);$i++)
        {
            if ($s[$i] == $s[$i - 1])
            {
                $count++;
                $res = max($res,$count);
            }else
            {
                $count = 1;
            }
        }
        return $res;
    }
}
