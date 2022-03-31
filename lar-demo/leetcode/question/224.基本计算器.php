<?php
class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function calculate($s) {

        $strlen = strlen($s);
        $res = 0;
        $op = "";
        for($i = 0;$i < $strlen;$i++)
        {
            if ($s[$i] === ' ') continue;

            if (is_numeric($s[$i]))
            {dump($s[$i],"是数字");
                $number = "";
                while(isset($s[$i]) && is_numeric($s[$i]) )
                {
                    $number .= $s[$i];
                    $i++;
                }
                $i--;
                if ($op === "")
                {
                    $res += (int)$number;
                }else
                {
                    $res = $this->cacl($op,$res,$number);
                }
            }
            elseif(in_array($s[$i],["+","-","*","/"]))
            {
                $op = $s[$i];
            }else{

            }
        }
        return $res;
    }

    //计算
    function cacl($op,$num1,$num2)
    {
        switch ($op)
        {
            case "+":
                return $num1 + $num2;
            case "-":
                return $num1 - $num2;
            case "*":
                return $num1 * $num2;
            case "/":
                return $num1 / $num2;
        }
    }



}




$so = new Solution();
$s = " 2-1 + 2 ";
$res = $so->calculate($s);
dump($res,$res == 2-1+2);

$s = "1 + 1";
$res = $so->calculate($s);
dump($res,$res == 1+1);

$s = "1 + (1-1)";
$res = $so->calculate($s);
dump($res,$res == 1+(1-1));
