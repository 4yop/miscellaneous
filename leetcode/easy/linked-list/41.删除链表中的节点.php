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
    function deleteNode($head, $n) {
        $currentNode = new ListNode(-1);
        $currentNode->next =  $head;
        while ($currentNode->next != NULL){
            if($currentNode->next->val === $n){
                $currentNode->next = $currentNode->next->next;
                return $head;
            }
            $currentNode = $currentNode->next;
        }
    }
}

$head = [4,5,1,9];
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
$node = 5;

$s = new Solution();
$res = $s->deleteNode($head,$node);
print_r($res);
