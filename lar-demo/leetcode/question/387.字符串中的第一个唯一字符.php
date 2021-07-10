<?php
class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function firstUniqChar($s) {
        $map = [];
        for ($i = 0;$i < strlen($s);$i++)
        {
            if ( !isset($map[$s[$i]]) )
            {
                $map[$s[$i]] = 1;
            }else{
                $map[$s[$i]]++;
            }
        }

        for ($i = 0;$i < strlen($s);$i++)
        {
            if ($map[$s[$i]] == 1)
            {
                return $i;
            }
        }

        return -1;
    }
}
