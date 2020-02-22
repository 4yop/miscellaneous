<?php
// 234. 回文链表
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {


    function isPalindrome($head) {
        $fast = $head;
        $slow = $head;
        $temp = [];
        while($fast != NULL && $fast->next != NULL){
            $temp[] = $slow->val;
            $fast = $fast->next->next;
            $slow = $slow->next;
        }

        print_r($fast);
        print_r($slow);
        print_r($temp);
    }
}

$head = [1,999,3,999,1];
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

$res = $solution->isPalindrome($node);
print_r($res);