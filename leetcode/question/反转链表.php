<?php
// 206.反转链表
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {


    function reverseList($head) {
        $tempNode = NULL;
        $currentNode = $head;
        while($currentNode != NULL){
            $next = $currentNode->next;
            $currentNode->next = $tempNode;
            $tempNode = $currentNode;
            $currentNode = $next;
        }
        return $tempNode;
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

$res = $solution->reverseList($node);
print_r($res);