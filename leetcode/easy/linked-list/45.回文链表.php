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


    function isPalindrome($head) {
        $slow = $head;
        $fast = $head;
        $before = NULL;
        $snext = NULL;
        $fnext = NULL;
        while($fast->next != NULL){

            $snext = $slow->next;
            $fnext = $fast->next->next;

            $slow->next = $before;
            $before = $slow;

            $slow = $snext;
            $fast = $fnext;
        }

        $slow = $this->reverseList($slow);
        $before = $this->reverseList($before);

        while($before !== NULL){

            if($before->val !== $slow->val){
                echo "{$before->val}--{$slow->val}\n";
                return false;
            }
            $slow = $slow->next;
            $before = $before->next;
        }
        return true;
    }
    //反转链表
    function reverseList($head) {
        $currentNode = $head;
        $res = NULL;
        $nextNode = NULL;
        while($currentNode !== NULL){
            $nextNode = $currentNode->next;
            $currentNode->next = $res;
            $res = $currentNode;
            $currentNode = $nextNode;
        }
        return $res;
    }

}

$head = [1,2];
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

//print_r($node);

$head = $node;

$s = new Solution();
$res= $s->isPalindrome($head);
var_dump($res);
