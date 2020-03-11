<?php






class Solution {

    /**
     * @param Integer[] $A
     * @return Boolean
     */
    function canThreePartsEqualSum($A) {
        $count = count($A);
        //长度小于3就不能分成3块了
        if($count < 3){
            return false;
        }
        $sum = array_sum($A);
        //总和不能整除3就不能分成3块了
        if($sum % 3 != 0){
            return false;
        }
        $oneThird = $sum/3;
        $res = [];


        $temp = 0;
        foreach($A as $v){
            $temp += $v;
            if($temp == $oneThird){
                $res[] = true;
                $temp = 0;
            }
        }

        list($x,$y,$z) = $res;
        return $x === true &&  $y === true && $z === true;
    }
}
