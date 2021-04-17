<?php
class Solution {

    /**
     * @param String $moves
     * @return Boolean
     */
    function judgeCircle($moves) {
        $uc = substr_count($moves, 'U');
        $dc = substr_count($moves, 'D');
        $lc = substr_count($moves, 'L');
        $rc = substr_count($moves, 'R');
        return ($uc == $dc) && ($lc == $rc);
    }
}



