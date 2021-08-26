<?php






class Solution {

    /**
     * @param String $s
     * @param Integer $k
     * @return String
     */
    function reverseStr($s, $k) {

        $i = 0;
        $end = $i * $k + 1;
        while ($i < strlen($s))
        {
            $s[$i] = $s[$end - $i];
            if ($i >= ( $end - $k/2 ))
            {
                $i = $i * $k + 1 + 1;
            }else
            {
                $i++;
            }

        }
        return $s;
    }
}

$so = new Solution();
$s = "abcdefg";
$k = 2;
$res = $so->reverseStr($s,$k);
var_dump($res);
