<?php






class Solution {


    function findRestaurant($list1, $list2) {

        $min = PHP_INT_MAX;
        $res = [];
        $hash = array_flip($list1);
        foreach($list2 as $k => $v){
            if(array_key_exists($v,$hash) && $min >= $k + $hash[$v]){
                $min = $k + $hash[$v];
                $res[$min][] = $v;
            }
        }
        ksort($res);
        return current($res);
    }

}

$so = new Solution();
$s = 7; $nums = [2,3,1,2,4,3];

$res = $so->findRestaurant(["Shogun","Tapioca Express","Burger King","KFC"],
["KFC","Burger King","Tapioca Express","Shogun"]);
print_r($res);