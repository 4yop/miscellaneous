<?php


class Solution {

    /**
     * @param ListNode $head
     * @return Integer[]
     */
    function reversePrint($head) {
        $res = [];
        while($head !== null){
            array_unshift($res,$head->val);
            $head = $head->next;
        }
        return $res;
    }
}