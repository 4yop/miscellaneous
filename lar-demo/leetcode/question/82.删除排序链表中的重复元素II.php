<?php

//82. 删除排序链表中的重复元素II

use leetcode\common\ListNode;


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
    function deleteDuplicates($head)
    {
        if ($head === null)
        {
            return $head;
        }
        $listNode = new ListNode(-101);
        $listNode->next = $head;
        $node = $listNode;
        $temp = -101;
        while ($node->next !== null && $node->next->next !== null)
        {
            if ($node->next->val == $temp || $node->next->val == $node->next->next->val)
            {
                $temp = $node->next->val;
                $node->next = $node->next->next;
            }else
            {
                $node = $node->next;
            }
        }
        if ($node->next !== null && $node->next->val == $temp)
        {
            $node->next = $node->next->next;
        }
        return $listNode->next;
    }
}


$head = [1,1,1,2,3];


//生成链表
$head = (new \leetcode\common\Base())->buildListNodeByArr($head);

$solution = new Solution();

$res = $solution->deleteDuplicates($head);
var_dump($res);
