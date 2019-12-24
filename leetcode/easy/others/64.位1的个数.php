<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function hammingWeight($n) {
    	return unpack('cchars/nint',$n);
    }

    

}

$s = new Solution();

$res = $s->hammingWeight(00000000000000000000000000001011);
var_dump($res);







