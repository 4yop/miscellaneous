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

    /**
     * @param ListNode $head
     * @param Integer $n
     * @return ListNode
     */
    function removeNthFromEnd($head, $n) {
        $count = 0;
        $fast = $head;
        while($fast->next !== NULL){
            $count+=2;
            $fast = $fast->next->next;
        }
        if($fast !== NULL){
            ++$count;
        }
        $i = 0;
        $end = $count - $n;
        if($end === 0){
            return $head->next;
        }

        $slow = new ListNode(0);
        $slow->next = $head;
        while($slow->next !== NULL){
            if($i == $end){
                $slow->next = $slow->next->next;
                break;
            }
            $i++;
            $slow = $slow->next;

        }
        return $head;
    }
}

$head = [1];
$n = 1;

//生成链表
$node = new ListNode($head[0]);
$current = $node;
$i = 1;
while($i < count($head)){
    $val = $head[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}



$head = $node;

$s = new Solution();
$r = $s->removeNthFromEnd($head,$n);
print_r($r);
