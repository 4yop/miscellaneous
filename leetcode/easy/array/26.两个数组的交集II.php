<?php


class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function intersect($nums1, $nums2) {
        //一个为空就无交集
        if(empty($nums1) || empty($nums2)){
            return [];
        }
        //交换，哪个短 哪个就为$nums1
        if(count($nums1) > count($nums2)){
            $temp= $nums2;
            $nums2 = $nums1;
            $nums1 = $temp;
        }
        $intersect = [];
        foreach ($nums1 as $k => $v){
            $index = array_search($v,$nums2);
            if($index !== false){
                unset($nums2[$index]);
                $intersect[] = $v;
            }
        }
        return $intersect;
    }
}

$s = new Solution();
$res = $s->intersect([4,9,5],[9,4,9,8,4]);
print_r($res);