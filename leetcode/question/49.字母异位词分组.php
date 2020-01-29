<?php






class Solution {


    function groupAnagrams($strs) {

        foreach ($strs as $v){
            $arr = str_split($v);
            asort($arr);
            $str=implode('',$arr);
            $res[$str][] = $v;
        }
        return $res;
    }
}

$so = new Solution();
$nums = ["eat", "tea", "tan", "ate", "nat", "bat"];
$val = 3;
$res = $so->groupAnagrams($nums);
print_r($res);