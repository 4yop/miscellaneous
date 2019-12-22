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


    function mergeTwoLists($l1, $l2) {
        $current1 = $l1;
        $current2 = $l2;
        while ($current2 !== NULL){
            $next2 = $current2->next;

            while($current1 !== NULL){

                if($current2 >= $current1){
                    $next1 = $current1->next->next;
                    $current2->next = $next1;
                    $current1->next = $current2;
                    break;
                }
                $current1 = $current1->next;
            }

            $current2 = $next2;
        }
        return $l1;
    }
}

$head = [1,2,4];


//生成链表
$node = new ListNode($head[0]);
$current = $node;
$i = 1;
while($i < count($head)){
    $val = $head[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}

$l1 = $node;
$head = [1,3,4];


//生成链表
$node = new ListNode($head[0]);
$current = $node;
$i = 1;
while($i < count($head)){
    $val = $head[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}

$l2 = $node;
$s = new Solution();
$res= $s->mergeTwoLists($l1,$l2);
print_r($res);
