<?php
//876. 链表的中间结点
class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {


    function oddEvenList($head) {
        $odd = new ListNode(-1);
        $even = new ListNode(-1);

        $o = $odd;
        $e = $even;

        while($head !== NULL){

            $nextnext = $head->next->next;

            $o->next = $head;
            $e->next = $head->next;

            $o = $o->next;
            $e = $e->next;

            $head = $nextnext;
        }



        $o->next = $even->next;
        return $odd->next;
    }


}

$head = [1,2,3,4,5,6];
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

$res = $solution->oddEvenList($node);
print_r($res);