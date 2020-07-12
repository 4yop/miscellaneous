<?php
class Solution {

    /**
     * @param String $name
     * @param String $typed
     * @return Boolean
     */
    function isLongPressedName($name, $typed) {
        if($name == $typed){
            return true;
        }
        $j = 0;
        $i = 0;
        while($i < strlen($typed)){
            if($typed[$i] != $name[$j]){
                return false;
            }
            $num = $this->getSameLength($typed,$i);
            $num1 = $this->getSameLength($name,$j);
            if($num < $num1){
                return false;
            }
            $i = $num > 0 ? $i + $num : $i + 1;
            $j = $num1 > 0 ? $j + $num1 : $j + 1;
        }

        if($name[$j] != $typed[$i]){
            return false;
        }
        return true;


    }

    /**获取相同字符串的长度
     * @param $str
     * @param $i
     * @return int
     */
    function getSameLength($str,$i){
        $s = $str[$i];
        $num = 1;
        while($str[$i+1] == $s && $i < strlen($str))
        {
            $num++;
            $i++;
        }
        return $num;
    }
}

$so = new Solution();


$res = $so->isLongPressedName('alex','aaleex');
var_dump($res);

//
//$res = $so->getSameLength('lleeelee',0);
//var_dump($res);