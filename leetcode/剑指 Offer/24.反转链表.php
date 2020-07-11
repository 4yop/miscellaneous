<?php


class Solution {

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function reverseList($head) {
        $res = null;
        $node = $head;
        while($node !== null){
            $next = $node->next;
            $node->next = $res;
            $res = $node;
            $node = $next;
        }
        return $res;
    }
}