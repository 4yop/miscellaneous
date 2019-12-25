<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function countPrimes($n) {
    	$count = 0;
    	for($i = 1;$i<$n;$i++){
    		if($this->isPrimes($i)){
    			$count++;
    		}
    	}
        return $count;
    }

    function isPrimes($num){
    	if($num <= 3){
    		return $num > 1;
    	}
    	if($num % 6 != 1 && $num %6 != 5){
    		return false;		
    	}
    	$sqrt = intval(sqrt($num));
    	for ($i = 5; $i <= $sqrt; $i += 6) {
        if ($num % $i == 0 || $num % ($i + 2) == 0) {
            return false;
        }
    	}
    	return true;
    }

}

$s = new Solution();

$res = $s->countPrimes(2);
var_dump($res);







