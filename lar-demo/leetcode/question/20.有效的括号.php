<?php
class Solution {

    /**
     * @param String $s
     * @return Boolean
     */
    function isValid($s)
    {

        $strlen = strlen($s);
        if ( $strlen % 2 == 1)
        {
            return false;
        }
        $arr = [];
        for($i = 0;$i < $strlen;$i++)
        {
            if ($s[$i] == '(' || $s[$i] == '[' || $s[$i] == '{')
            {
                $arr[] = $s[$i];
            }
            elseif($s[$i] == ')' && array_pop($arr) != '(')
            {
               return false;
            }
            elseif($s[$i] == ']'  && array_pop($arr) != '[')
            {
               return false;
            }
            elseif($s[$i] == '}'  && array_pop($arr) != '{')
            {
               return false;
            }
        }
        return empty($arr);
    }
}


$s = new Solution();

$str = '(]';
$a = $s->isValid($str);

var_dump($a);
