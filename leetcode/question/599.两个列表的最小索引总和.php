<?php






class Solution {


    function findRestaurant($list1, $list2) {
        $max = max(count($list1),count($list2));
        $i = 0;



        $log1 = [];
        $log2 = [];

        $min = PHP_INT_MAX;
        $key = '';

        while($i < $max){

            if(!array_key_exists($list1[$i],$log1)) $log1[$list1[$i]] = $i;
            if(!array_key_exists($list2[$i],$log1)) $log2[$list2[$i]] = $i;

            if(array_key_exists($list1[$i],$log1) && array_key_exists($list1[$i],$log2) && $min > $log1[$list1[$i]] + $log2[$list1[$i]]){
                $min = $log1[$list1[$i]] + $log2[$list1[$i]];
                $key = $list1[$i];
            }
            if(array_key_exists($list2[$i],$log1) && array_key_exists($list2[$i],$log2) && $min > $log1[$list2[$i]] + $log2[$list2[$i]]){
                $min = $log1[$list2[$i]] + $log2[$list2[$i]];
                $key = $list2[$i];
            }
            $i++;
        }

        return $key;
    }

}

$so = new Solution();
$s = 7; $nums = [2,3,1,2,4,3];

$res = $so->findRestaurant(["Shogun", "Tapioca Express", "Burger King", "KFC"],
    ["KFC", "Shogun", "Burger King"]);
print_r($res);