<?php
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution {

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function reverseList($head) {
        $curr = $head;
        $res = null;
        while($curr !== NULL){
            $next = $curr->next;
            $curr->next = $res;
            $res = $curr;
            $curr = $next;
        }
        return $res;
    }
}