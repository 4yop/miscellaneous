<?php






class Solution {

    //暴力法
    // m = strlen($haystack)
    // n = strlen($needle)
    // 时间复杂度为  O(m*n)
    // 空间复杂度为 O(1)
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

    //kmp
    function strStr1($haystack,$needle)
    {


    }
}

$so = new Solution();
$nums = "";
$val = "1";
$res = $so->strStr($nums,$val);
print_r($res);

$res = $so->strStr1($nums,$val);
print_r($res);
