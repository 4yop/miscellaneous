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
    function detectCycle($head) {
        if ($head === null)
        {
            return null;
        }
        $slow = $head;
        $fast = $head;

        while ( $fast && $fast->next )
        {
            $slow = $slow->next;
            $fast = $fast->next->next;
            if ( $fast == $slow )
            {
                $slow2 = $head;

                while ($slow2 != $slow) {
                    $slow = $slow->next;
                    $slow2 = $slow2->next;
                }
                return $slow2;

            }
        }
        return null;
    }
}