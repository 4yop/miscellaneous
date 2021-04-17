<?php
//876. 链表的中间结点
class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {


    function middleNode($head) {
        /**
         * 因为 slow一次走一步 fast一次走两步  ，fast到终点了，slow才到一半
         */
        $fast = $head;
        $slow = $head;
        while($fast != NULL && $fast->next != NULL){
            $slow = $slow->next;
            $fast = $fast->next->next;
        }
        return $slow;
    }
}

$head = [1,2,3,4,5];
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

$res = $solution->middleNode($node);
print_r($res);