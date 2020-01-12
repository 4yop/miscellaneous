<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */

class Solution {


    function canVisitAllRooms($rooms) {

        $i = 0;
        while(!empty($rooms[$i])){
            $i = $rooms[$i][0];
            
        }
        return true;
    }
}

$solution = new Solution();//bacdfeg
$s = "Let's take LeetCode contest";
$res = $solution->canVisitAllRooms([[1],[2],[3],[]]);
var_dump($res);