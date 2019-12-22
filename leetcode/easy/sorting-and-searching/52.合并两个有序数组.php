<?php


class Solution {


    function merge($nums1, $m, $nums2, $n) {

        $end = $m + $n;

        for($i = $m;$i < $end;$i++){
            $nums1[$i] = current($nums2);
            next($nums2);
        }

        return $nums1;
    }
}

$nums1 = [1,2,3,0,0,0]; $m = 3;
$nums2 = [2,5,6];      $n = 3;
    $s = new Solution();

$res = $s->merge($nums1, $m, $nums2, $n);
var_dump($res);