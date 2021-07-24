<?php
class Solution {

    /**
     * @param String $time
     * @return String
     */
    function maximumTime($time) {
        list($h,$m) = explode(':',$time);
        if ($h[0] == '?')
        {
            if ($h[1] > 3)
            {
                $h[0] = 1;
            }else
            {
                $h[0] = 2;
            }
        }

        if($h[1] == '?')
        {
            if ($h[0] <= 1)
            {
                $h[1] = 9;
            }else
            {
                $h[1] = 3;
            }
        }
        if ($m[0] == '?')
        {
            $m[0] = 5;
        }
        if($m[1] == '?')
        {
            $m[1] = 9;
        }
        return "{$h}:{$m}";
    }
}
