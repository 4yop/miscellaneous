<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/20
 * Time: 16:14
 */
class Solution {

    /**
     * @param String[] $s
     * @return NULL
     */
    function reverseString(&$s) {
        $j = count($s) - 1;
        $i = 0;
        while($i < $j){
            $temp = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $temp;
            $i++;
            $j--;
        }
    }
}

$s = new Solution();
$res = $s->reverse("words and 987");
print_r($res);