<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
//44.通配符匹配
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function isMatch($s, $p) {
        $end1 = strlen($s);
        $end2 = strlen($p);
        $i = 0;$j = 0;
        if($p === '*'){
            return true;
        }
        if($end1 != $end2 && strpos('*',$p) === false){
            return false;
        }


        while($i < $end1 || $j < $end2){
            echo "$s[$i]--$p[$j]";
            if($p[$j] == '*'){

            }if($s[$i] !== $p[$j] && $p[$j] != '?'){
                return false;
            }
            $i++;
            $j++;
        }
        return true;
    }
}

$solution = new Solution();//bacdfeg
$folders =[
    'aa' => 'a',
    'aaa' => '*',
    'cb' => '?a',
    'adceb' => 'a*b',
    'acdcb' => 'a*c?b',
];
foreach ($folders as $s => $p) {
    $res = $solution->isMatch($s, $p);
    var_dump($res);
}
