<?php






class Solution {


    function isMatch($s, $p) {

        if($s == $p){
            return true;
        }

        if(strpos($p,'.') === false && strpos($p,'*') === false && $s != $p){
            return false;
        }


        $j = 0;

        for ($i = 0;$i < strlen($p);$i++){



            if($p[$i] == '.' || $p[$i] == $s[$j]){
//                $p[$i] = $s[$j];
                $j++;
                continue;
            }

            if($p[$i] == '*'){
                $str = $p[$i-1] == '.' ? $s[$j] : $p[$i-1];
                if($s[$j] != $str){
                    echo '11'."\n";
                    return false;
                }else{
                    while($s[$j] == $str){
                        $j++;
                    }
                }
            }elseif($p[$i] != $s[$j]){
                if($p[$i+1] == '*'){
                    $i = $i + 2;
                }else{
                    echo '22'."\n";
                    return false;
                }
            }
            echo "s[$j]:$s[$j]--p[$i]:$p[$i] \n";
        }

        echo "$j --".(strlen($s) - 1)."\n";
        if($j  < strlen($s) ){
            return false;
        }

        return true;
    }


}

$so = new Solution();
$nums = [-1, 0, 1, 2, -1, -4];
$val = 3;
/**
 * mi mi
 * s* ss
 * i  i
 * s* ss
 * p* i
 * .  ppi
 *
 *  "mississippi"
    "mis*is*ip*."
 *
 *  "mississippi"
    "mis*is*p*."
 */
$res = $so->isMatch("aaa","a*a");
var_dump($res);