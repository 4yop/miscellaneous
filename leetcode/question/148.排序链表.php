<?php
//876. 链表的中间结点
class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {


    function sortList($head) {
        if($head == null || $head->next == null) return $head;
        $fast = $head->next;
        $slow = $head;
        while($fast != null && $fast->next != null){
            $slow = $slow->next;
            $fast = $fast->next->next;
        }
        $tmp = $slow->next;
        $slow->next = null;
        $left = $this->sortList($head);
        $right = $this->sortList($tmp);
        $dummy = new ListNode(0);
        $h = $dummy;
        while($left != null && $right != null){
            if($left->val < $right->val){
                $h->next = $left;
                $left = $left->next;
            }else{
                $h->next = $right;
                $right = $right->next;
            }
            $h = $h->next;
        }
        $h->next = ($left != null)?$left:$right;
        return $dummy->next;

    }


}

$head = [4,2,1,3,5];
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

$res = $solution->sortList($node);
print_r($res);