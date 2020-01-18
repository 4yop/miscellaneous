<?php
class Solution {

    
    function missingNumber($nums) {
		sort($nums);
    	$i = 0;
    	while (true) {
    		if($i != current($nums)){
    			return $i;
    		}
    		$i++;
    		next($nums);
    	}
    }

    

}

$s = new Solution();

$res = $s->missingNumber([9,6,4,2,3,5,7,0,1]);
var_dump($res);







