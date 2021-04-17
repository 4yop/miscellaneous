<?php
class Solution {


    function intersection($nums1, $nums2) {
        if(empty($nums1) || empty($nums2)){
            return [];
        }
        $res = [];
        $nums1 = array_unique($nums1);
        $nums2 = array_unique($nums2);
        foreach($nums1 as $v){
            if(in_array($v,$nums2)){
                $res[] = $v;
            }
        }
        return $res;
    }

    function test1($nums1, $nums2) {
        $nums1 = array_unique($nums1);
        $nums2 = array_unique($nums2);
        sort($nums1);
        sort($nums2);
        $count1 = count($nums1);
        $count2 = count($nums2);
        $i=0; $j=0;
        $ins = [];
        while($i<$count1 && $j<$count2){
            if($nums1[$i] == $nums2[$j]){
                $ins[] = $nums1[$i];
                $i++;
                $j++;
            }elseif($nums1[$i]<$nums2[$j]){
                $i++;
            }else{
                $j++;
            }
        }
        return $ins;
    }
}

$s = new Solution();
$r = $s->intersection([1,2,2,1],[2,2]);
var_dump($r);