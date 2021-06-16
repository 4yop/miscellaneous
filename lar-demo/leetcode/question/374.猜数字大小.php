<?php
/**
 * The API guess is defined in the parent class.
 * @param  num   your guess
 * @return 	     -1 if num is lower than the guess number
 *			      1 if num is higher than the guess number
 *               otherwise return 0
 * public function guess($num){}
 */

class Solution extends GuessGame {
    /**
     * 二分查找
     * 时间复杂度：O(log n)
     * 空间复杂度：o(1)
     * @param  Integer  $n
     * @return Integer
     */
    function guessNumber($n) {
        $start = 1;
        $end = $n;
        while($start < $end)
        {
            $mid = floor($start+($end-$start)/2);
            if ($this->guess($mid) <= 0)
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
