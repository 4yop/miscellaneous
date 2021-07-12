<?php

//82. 删除排序链表中的重复元素II

require_once '../common/base.php';


/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution {

    /**
     * @param ListNode $head
     * @return ListNode
     */
    function deleteDuplicates($head) {
        $node = $head;
        while ($node !== null && $node->next !== null)
        {
            if ($node->val == $node->next->val)
            {
                $node->next = $node->next->next;
            }
            else
            {
                $node = $node->next;
            }
        }
        return $head;
    }
}
