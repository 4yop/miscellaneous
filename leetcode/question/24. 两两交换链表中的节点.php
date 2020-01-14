<?php
// 24. 两两交换链表中的节点
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {


    function swapPairs($head) {
        $currentNode = new ListNode(-1);
        $currentNode->next = $head;
        while($currentNode->next->next != NULL){



            $next1 = $currentNode->next;
            $next2 = $currentNode->next->next;
            $next3 = $currentNode->next->next->next;
            print_r(compact('next1','next2','next3'));
            $next1->next = $next3;
            $next2->next = $next1;
            print_r(compact('next1','next2'));
            $currentNode = $next2;
            $currentNode = $currentNode->next->next;
        }
        return $head;
    }
}

$head = [1,2,3,4];
$n = 0;

//生成链表
$node = new ListNode($head[0]);
$current = $node;
$i = 1;
while($i < count($head)){
    $val = $head[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}

$solution = new Solution();

$res = $solution->swapPairs($node);
print_r($res);