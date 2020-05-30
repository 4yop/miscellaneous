<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
class Solution {

    /**
     * @param String $S
     * @return String[]
     */
    function letterCasePermutation($S) {
        $strlen = strlen($S);
        if($strlen < 1 || is_numeric($S)){
            return [$S];
        }
        $queue = [''];

        for($i = 0;$i<$strlen;$i++){
            $len = count($queue);
            for($j=0;$j < $len;$j++) {
                $str1 = array_shift($queue);
                if (ctype_alpha($S[$i])) {
                    array_push($queue, $str1 . strtolower($S[$i]), $str1 . strtoupper($S[$i]));
                } else {
                    array_push($queue, $str1 . $S[$i]);
                }
            }
        }
        return $queue;
    }


}

$solution = new Solution();
$res = $solution->letterCasePermutation("ABR");
print_r($res);