<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/18
 * Time: 16:34
 */
class Solution {

    /**
     * @param String $word
     * @return Boolean
     */
    function fizzBuzz($n) {

        return array_map(function($value){
            switch ($value){
                case $value % 15 == 0:return 'FizzBuzz';
                case $value % 5 == 0:return 'Fizz';
                case $value % 3 == 0:return 'Buzz';
                default:return $value;
            }
        },range(1,$n,1));
    }
}

$s = new Solution();
$res = $s->fizzBuzz(15);
var_dump($res);