<?php
class Solution {

    /**
     * @param String $s
     * @param String $t
     * @return String
     */
    function toDo($n) {

        $len = strlen($n);
        $guocheng = [];
        $sum = 0;
        for ($i = 0;$i < $len;$i++){
            $sum += intval($n[$i] * $n[$i]);
        }

        return $sum;
    }
}

$so = new Solution();

$res = $so->toDo(19);

print_r($res);