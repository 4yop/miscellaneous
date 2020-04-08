<?php






class Solution {

    /**
     * @param Integer $n
     * @return String
     */
    function countAndSay($n) {
        $str = 1;
        for($i = 0;$i < $n;$i++){
            $temp = "";
            $strlen = strlen($str);
            $count = 0;
            $s = $str[0];
            for($j = 0;$j< $strlen;$j++){
                if($s == $str[$j]){
                    $count++;
                }else{
                    $temp .= $count.$s;
                    $count = 1;
                    $s = $str[$j];
                }
            }
            $str = $temp.$count.$s;
        }
        return $str;
    }
}

$so = new Solution();

//1211
$res = $so->countAndSay( 4);
print_r($res);