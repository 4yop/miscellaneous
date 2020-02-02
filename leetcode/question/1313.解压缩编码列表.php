<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function decompressRLElist($nums) {
        $i = 0;
        while($i < count($nums)){
            for($j = 0;$j < $nums[$i];$j++){
                $res[] = $nums[$i+1];
            }
            $i += 2;
        }


        return $res;
    }
}