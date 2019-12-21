<?php
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class ListNode {
     public $val = 0;
     public $next = null;
     function __construct($val) { $this->val = $val; }
 }
class Solution {


    function reverseList($head, $n) {
        $curr = $head;
        $temp = $curr;
        $temp->next = NULL;
        while($curr->next === NULL){

            $aa = $curr;
            $aa->next = $temp;
            $temp = $aa;

            $curr = $curr->next;
        }
        return $temp;
    }
}

$head = [1,2,3,4,5];
$n = 2;

//生成链表
$node = new ListNode($head[0]);
$current = $node;
$i = 1;
while($i < count($head)){
    $val = $head[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}

print_r($node);

$head = $node;

$s = new Solution();
$res= $s->reverseList($head,$n);
var_dump($res);
