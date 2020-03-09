<?php

class Solution {

    /**
     * @param String $s
     * @param String $t
     * @return Boolean
     */
    function isIsomorphic($s, $t) {
        $len =  strlen($s);
        if($len !== strlen($t)) return false;

        $s1 = [];
        $t1 = [];
        // $s = str_split($s);
        // $t = str_split($t);
        $i = 0;

        while($i < $len ){
            if(!isset($s1[ $s[$i] ]) ){
                $s1[ $s[$i] ] = $i;
            }
            if(!isset($t1[ $t[$i] ]) ){
                $t1[ $t[$i] ] = $i;
            }
            if($t1[ $t[$i] ] !== $s1[ $s[$i] ]){
                return false;
            }
            $i++;
        }

        return true;
    }
}