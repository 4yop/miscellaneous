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
    function hasCycle($head) {
        $slow = $head;
        $fast = $head;
        while($fast !== NULL && $fast->next !== NULL){
            $slow = $slow->next;
            $fast = $fast->next->next;
            if($fast == $slow){
                return true;
            }
        }
        return NULL;
    }
}

$head = [3,2,0,-4];
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
$node = 5;

$s = new Solution();
$res = $s->hasCycle($head,$node);
var_dump($res);
