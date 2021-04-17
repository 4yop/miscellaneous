<?php


require_once "../../learn/data/linked-list.php";
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution {

    /**
     * @param ListNode $headA
     * @param ListNode $headB
     * @return ListNode
     */
    function getIntersectionNode($headA, $headB) {
        $A = $headA;
        $B = $headB;
        while($A !== $B){
            $A = $A == null ? $headB : $A->next;
            $B = $B == null ? $headA : $B->next;
        }

        return $A;
    }
}

$arr =  [4,1,8,4,5];
$headA = (new LinkedList())->create($arr);

$arr =  [5,6,1,8,4,5];
$headB = (new LinkedList())->create($arr);

$res = (new Solution())->getIntersectionNode($headA, $headB);
var_dump($res);