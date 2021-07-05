<?php

class Solution {

    /**
     * @param String $formula
     * @return String
     */
    function countOfAtoms($formula) {
        $strlen = strlen($formula);
        $res = [];
        $pos = strlen($formula);
        for ($i = 0;$i < $strlen;$i++)
        {
            if ($formula[$i] == '(')
            {
                $this->helper($pos,$formula);
            }


            if (!isset($res[$formula[$i]]))
            {
                $res[$formula[$i]] = 0;
            }
            if ($i+1 < $strlen && is_numeric($formula[$i+1]) )
            {
                $res[$formula[$i]] += $formula[$i+1];
                $i++;
            }else
            {
                $res[$formula[$i]] += 1;
            }
        }
        return $res;
    }

    function helper($pos,$formula)
    {

        while ($formula[$pos] != ')')
        {
            $pos--;
        }
    }

}

$formula = "(H2O)2";

$s = new Solution();

$r = $s->countOfAtoms($formula);
var_dump($r);
