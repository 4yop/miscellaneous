<?php
/* The isBadVersion API is defined in the parent class VersionControl.
      public function isBadVersion($version){} */


class VersionControl{
    function isBadVersion($n)
    {

        return $n == 4 ? true: false;
    }
}

class Solution extends VersionControl {

    /** 二分查找
     * O(n)
     * O(1)
     * @param Integer $n
     * @return Integer
     */
    function firstBadVersion($n) {
        $start = 1;
        $end = $n;
        while ($start < $end)
        {
            $mid = floor($start + ($end - $start)/2);
            if ($this->isBadVersion($mid))
            {
                $end = $mid;
            }else
            {
                $start = $mid + 1;
            }
        }
        return $start;
    }
}

$s = new Solution();

$a = $s->firstBadVersion(5);

var_dump($a);
