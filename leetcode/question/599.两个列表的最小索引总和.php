<?php






class Solution {


    function findRestaurant($list1, $list2) {

        $res = PHP_INT_MAX;
        $key = "";

        $arr = array_merge_recursive(array_flip($list1),array_flip($list2));
        foreach ($arr as $k => $v){
            if(is_array($v)){
                $sum = array_sum($v);
                if($sum < $res){
                    $res = $sum;
                    $key = $k;
                }
            }
        }
        return $key;
    }

}

$so = new Solution();
$s = 7; $nums = [2,3,1,2,4,3];

$res = $so->findRestaurant(["Shogun", "Tapioca Express", "Burger King", "KFC"],
    ["KFC", "Shogun", "Burger King"]);
print_r($res);