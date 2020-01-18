<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2020/1/17
 * Time: 11:21
 */

class Solution {

    /**
     * @param Integer $N
     * @return Integer
     */
    //递归
    function fib($N) {
        if($N < 2){
            return $N;
        }

        return $this->fib($N - 1) + $this->fib($N - 2);
    }

    //迭代
    function fib1($N){
        if($N < 2){
            return $N;
        }
        $i = 2;
        $one = 0;
        $two = 1;

        while($i <= $N){
            $temp = $two;
            $two = $one + $two;
            $one = $temp;
            $i++;
        }
        return $two;
    }
}

$res = (new Solution())->fib(4);


var_dump($res);