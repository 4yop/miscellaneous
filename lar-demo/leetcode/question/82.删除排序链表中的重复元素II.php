<?php

//82. 删除排序链表中的重复元素II

require_once '../common/base.php';


//class ListNode {
//    public $val = 0;
//    public $next = null;
//    function __construct($val) { $this->val = $val; }
//}

class Solution {

    /**
     * @param ListNode $head
     * @param Integer $n
     * @return ListNode
     */
    function deleteDuplicates($head) {
        $node = new ListNode(-1);
        $node->next = $head;
        $curr = $node;


        while ($curr->next !== null && $curr !== null)
        {
            if ($curr->next->val !== $curr->next->next->val) {
                $curr = $curr->next;
                continue;
            }
            while ($curr->next->val === $curr->next->next->val) {
                $curr->next->next = $curr->next->next->next;
            }
            $curr = $curr->next->next;
        }
        return $node->next;
    }
}


$head = [1,2,3,3,4,4,5];


//生成链表

$node = buildListNodeByArr($head);

$solution = new Solution();

$res = $solution->deleteDuplicates($node);
print_r($res);