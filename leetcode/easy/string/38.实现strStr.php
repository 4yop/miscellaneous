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
    function strStr($haystack, $needle) {
        if($needle === '' || $haystack === $needle){
            return 0;
        }
        $nend = strlen($haystack);
        $nlen = strlen($needle);
        $hend = $nend - strlen($needle) + 1;

        for($i = 0;$i < $hend;$i++){
            if($haystack[$i] === $needle[0]){

                $temp = $i+1;
                $flag = true;
                for($j = 1;$j<$nlen;$j++){

                    if($haystack[$temp] != $needle[$j]){
                        $flag = false;
                        $j = $nlen;
                    }
                    $temp++;
                }
                if($flag){
                    return $i;
                }
            }
        }
        return -1;
    }
}

$s = new Solution();
$res = $s->strStr("hello",'ll');
var_dump($res);