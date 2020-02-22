<?php
$arr=array('a','b','c','d','e','f','g');
$i_arr=array('1','2');
$n=2;
array_splice($arr,$n,0,$i_arr);
print_r($arr);