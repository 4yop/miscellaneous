<?php
//917. 仅仅反转字母
class Solution {


    function reverseOnlyLetters($S) {
        $i = 0;
        $j = strlen($S) - 1;
        while($i < $j){

                $ordi = ord($S[$i]);
                if(!(($ordi >= 65 && $ordi <= 90) || ($ordi >= 97 && $ordi <= 122))){
                    while($i<$j){
                        $ordi = ord($S[++$i]);
                        if(($ordi >= 65 && $ordi <= 90) || ($ordi >= 97 && $ordi <= 122)){
                            break;
                        }
                    }
                }

                $ordj = ord($S[$j]);
                if(!(($ordj >= 65 && $ordj <= 90) || ($ordj >= 97 && $ordj <= 122))){
                    while($i<$j){
                        $ordj = ord($S[--$j]);
                        if(($ordj >= 65 && $ordj <= 90) || ($ordj >= 97 && $ordj <= 122)){
                            break;
                        }
                    }
                }

                if(($ordi >= 65 && $ordi <= 90) || ($ordi >= 97 && $ordi <= 122) && ($ordj >= 65 && $ordj <= 90) || ($ordj >= 97 && $ordj <= 122)){

                    $temp = $S[$i];
                    $S[$i] = $S[$j];
                    $S[$j] = $temp;

                }



                $i++;
                $j--;

        }
        return $S;
    }
}

$so = new Solution();
$res = $so->reverseOnlyLetters("ab-cd");
print_r($res);