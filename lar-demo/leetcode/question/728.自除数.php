<?php
class Solution {

    /**
     * @param Integer $left
     * @param Integer $right
     * @return Integer[]
     */
    function selfDividingNumbers($left, $right) {
        $res = [];
        for($i = $left;$i<=$right;$i++)
        {
            $strlen = strlen($i);
            $flag = true;
            for($j = 0;$j<$strlen;$j++)
            {
                $n = (string)$i;
                if ($n[$j] == 0 || $i%($n[$j]) != 0)
                {
                    $flag = false;
                    break;
                }
            }
            if ($flag)
            {
                $res[] = $i;
            }
        }
        return $res;
    }
}

$s = new Solution();
$res = $s->selfDividingNumbers(1,22);
dump($res);
