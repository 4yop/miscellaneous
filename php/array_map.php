<?php

$function = function($a){
    return "--{$a}--";
};
$data = range(0,10,2);
$arr = array_map($function,$data);

print_r($arr);

/**
Array
(
    [0] => --0--
    [1] => --2--
    [2] => --4--
    [3] => --6--
    [4] => --8--
    [5] => --10--
)

 */