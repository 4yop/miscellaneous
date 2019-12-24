<?php
class Solution {

    
    function isValid($s) {
		$end = strlen($s) - 1;
		if($s[0] == ')' || $s[0] == ']' || $s[0] == '}' || $s[$end] == '(' || $s[$end] == '[' || $s[$end] == '{'){
				return false;
		}
		
		$left = [];//左括号
		for($i = 0;$i<=$end;$i++){
			if($s[$i] == '(' || $s[$i] == '[' || $s[$i] == '{'){
				$left[] = $s[$i];
				continue;
			}
			$pop = array_pop($left);
			if( ($s[$i] == ')' && $pop != '(') || ($s[$i] == ']' && $pop != '[') || ($s[$i] == '}' && $pop != '{') ){
				return false;
			}
		}
		return empty($left);
    }

    

}

$s = new Solution();

$res = $s->isValid("{[]]");
var_dump($res);







