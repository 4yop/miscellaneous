<?php
//143. 重排链表
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {


    function reorderList($head) {
        $fast = $head;
        $slow = $head;

        while($fast != NULL){
            $fast = $fast->next->next;
            $slow = $slow->next;
        }


        $q = $slow;
        $t = NULL;
        while($q != NULL){
            $s = new ListNode($q->val);
            $s->next = $t;
            $t = $s;
            $q = $q->next;
        }

        $s1 = $s;
        $a = $head;
        $a;
    }
}

$l1 = [1,2,3,4,5,6];

//生成链表
$node = new ListNode($l1[0]);
$current = $node;
$i = 1;
while($i < count($l1)){
    $val = $l1[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}





$solution = new Solution();

$res = $solution->reorderList($node);
print_r($res);