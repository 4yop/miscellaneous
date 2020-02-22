<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/20
 * Time: 16:14
 */
class Solution {

    /**
     * @param String[] $strs
     * @return String
     */
    function longestCommonPrefix($strs) {
        $min = strlen($strs[0]);//最小长度
        $minStr = $strs[0];//最短字符串
        $end = count($strs);
        //找最短字符串出来
        for($i = 1;$i<$end;$i++){
            $len = strlen($strs[$i]);
            if($len < $min){
                $min = $len;
                $minStr = $strs[$i];
            }
        }
        $pre = '';//前缀

        for($i = 1;$i <= $min;$i++){
            $temp = substr($minStr,0,$i);
            for($j = 0;$j < $end;$j++){
                if(strpos($strs[$j],$temp) !== 0){
                    return $pre;
                }
            }
            $pre = $temp;
        }

        return $pre;
    }
}

$s = new Solution();
$res = $s->longestCommonPrefix(["flower","flow","flight"]);
print_r($res);