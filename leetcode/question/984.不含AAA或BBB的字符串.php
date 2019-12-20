<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
//984. 不含 AAA 或 BBB 的字符串
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function strWithout3a3b($A, $B) {
        $str = '';
        if($A > $B){
            $big = $A;
            $small = $B;
            $bStr = 'a';
            $sStr = 'b';
        }else{
            $big = $B;
            $small = $A;
            $bStr = 'b';
            $sStr = 'a';
        }
        while($big != 0 || $small != 0){
            if($big >= 2){
                $str .= $bStr.$bStr;
                $big-=2;
            }else if($big == 1){
                $str .= $bStr;
                $big--;
            }
            if($big > 0 && $small > 0){
                $str .= $sStr;
                $small--;
            }else{
                $str = $sStr.$str;
                $small--;
            }
        }
        return $str;
    }
}


    $solution = new Solution();
    $res = $solution->strWithout3a3b(4, 4);
    var_dump($res);

