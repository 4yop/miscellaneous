<?php
class Solution {

    /**
     * @param String $s
     * @param Integer[] $indices
     * @return String
     */
    function restoreString($s, $indices) {
        $strlen = strlen($s);
        if ($strlen < 1)
        {
            return '';
        }
        $arr = [];
        for($i = 0;$i < $strlen;$i++)
        {
            $key = $indices[$i];
            $arr[$key] = $s[$i];
        }
        ksort($arr);
        return implode('',$arr);
    }
}

$s = new Solution();
$res = $s->restoreString('codeleet',[4,5,6,7,0,2,1,3]);

print_r($res);

