<?php

<<<<<<< HEAD
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

        while($A != $B){
            echo "A:{$A->val},B:{$B->val}\n";
            $A = $A == null ? $headB : $A->next;
            $B = $B == null ? $headA : $B->next;
        }

        return $A;
    }
}

$arr =  [4,1,8,4,5];
$headA = (new LinkedList())->create($arr);

$arr =  [5,0,1,8,4,5];
$headB = (new LinkedList())->create($arr);

$res = (new Solution())->getIntersectionNode($headA, $headB);
var_dump($res);

=======
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {

    function getIntersectionNode($headA, $headB) {

    }

}

$head = [4,1,8,4,5];
//生成链表
$node = new ListNode($head[0]);
$current = $node;
$i = 1;
while($i < count($head)){
    $val = $head[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}

$head = [5,0,1,8,4,5];
//生成链表
$node2 = new ListNode($head[0]);
$current = $node;
$i = 1;
while($i < count($head)){
    $val = $head[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}

$solution = new Solution();

$res = $solution->getIntersectionNode($node);
var_dump($res);
>>>>>>> cad920d202aae72e826896e1bd0b568df52f78d9
