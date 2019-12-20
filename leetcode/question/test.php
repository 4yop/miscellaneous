v<?php
//循环用某function 可用array_map(functionName,parame);一句	
	$arr = [1,2=>[1,2,3],3,4,5];
	$res = array_map('is_array',$arr);
	print_r($res);
