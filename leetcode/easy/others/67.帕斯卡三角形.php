<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function generate($numRows) {
		
		$arr = [
			[1],
			[1,1],
		];
		
    	for($i = 2;$i<$numRows;$i++){
			$arr[$i][0] = 1;
			for($j = 1;$j<$i;$j++){
				
			}
			$arr[$i][$numRows-1]=1;
		}
    }

    

}

$s = new Solution();

$res = $s->generate();
var_dump($res);







