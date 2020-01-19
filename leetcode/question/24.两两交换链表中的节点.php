<?php
//876. 链表的中间结点
class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {


    function swapPairs($head) {
        if($head === NULL){
            return $head;
        }
        $curr = $head;
        while($curr !== NULL){

            $next = $curr->next;
            $nextnext = $next->next;

            $curr->next = $nextnext;
            $next->next = $curr;

            $curr = $nextnext;
        }
        return $head;
    }


}

$head = [1,2,3,4];
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

$res = $solution->swapPairs($node,2);
print_r($res);