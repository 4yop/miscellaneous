<?php


class Solution {


    function fourSumCount($A, $B, $C, $D) {
        $count = 0;

        $arr = [];

        foreach ($A as $a){
            foreach ($B as $b){
                $arr[] = $a + $b;
            }
        }

        $temp = array_count_values($arr);

        foreach ($C as $c){
            foreach ($D as $d){

                $cha = 0-$c-$d;
                if(array_key_exists($cha,$temp)){
                    $count+=$temp[$cha];
                }

            }
        }


        return $count;
    }
}
