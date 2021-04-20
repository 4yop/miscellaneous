<?php






class Solution {

    /**
     * @param String $haystack
     * @param String $needle
     * @return Integer
     */
    function strStr($haystack, $needle)
    {
        $len = strlen($needle);
        $end = strlen($haystack) - $len;
        for($i = 0;$i <= $end;$i++)
        {
            $flag = true;
            $temp = $i;
            for($j = 0;$j < $len;$j++)
            {
                if ($haystack[$temp] != $needle[$j])
                {
                    $flag = false;
                    break;
                }

                $temp++;

            }
            if ($flag == true) {
                return $i;
            }
        }
        return -1;
    }
}

$so = new Solution();
$nums = "";
$val = "";
$res = $so->strStr($nums,$val);
print_r($res);
