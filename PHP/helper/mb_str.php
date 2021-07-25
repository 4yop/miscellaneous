<?php

//中午呢字符串分割数组
function mb_str_split($str)
{
    return preg_split('/(?<!^)(?!$)/u', $str );
}