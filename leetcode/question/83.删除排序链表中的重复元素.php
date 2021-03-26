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
        $list = new ListNode(-1);
        $list->next = $head;
        $curr = $list;
        while ($curr != null && $curr->next !== null) {
            if ($curr->next->val == $curr->next->next->val) {
                $curr->next = $curr->next->next;
            }else{
                $curr= $curr->next;
            }
        }
        return $list->next;
    }
}