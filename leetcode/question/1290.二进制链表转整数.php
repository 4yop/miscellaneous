<?php

class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {


    function getDecimalValue($head) {
        $currentNode = $head;
        $num = '';
        while($currentNode !== NULL){
            $num .= $currentNode->val;
            $currentNode = $currentNode->next;
        }
        return bindec($num);
    }
}

$head = [1,0,0,1,0,0,1,1,1,0,0,0,0,0,0];
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

$res = $solution->getDecimalValue($node);
print_r($res);
