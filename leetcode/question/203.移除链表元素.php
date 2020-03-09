<?php

class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {

    //迭代
    function removeElements($head, $val) {
        $node = new ListNode(-1);
        $node->next = $head;
        $curr = $node;
        while ($curr->next !== NULL){

            if($curr->next->val == $val){
                $curr->next = $curr->next->next;
            }else{
                $curr = $curr->next;
            }
        }
        return $node->next;
    }

    //递归
    function removeElements1($head,$val){
        if($head === NULL){
            return;
        }
        $head->next = $this->removeElements($head->next,$val);
        return $head->val === $val ? $head->next : $head;
    }
}

$head = [1,2,6,3,4,5,6];
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

$res = $solution->removeElements1($node,6);
var_dump($res);