<?php
//876. 链表的中间结点
use fast\Tree;

class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {
    //双指针
    function partition($head, $x) {
        $a = new ListNode(-1);
        $b = new ListNode(-1);
        $a1 = $a;
        $b1 = $b;
        while($head !== null){
            $next = $head->next;
            if($head->val >= $x){
                $b1->next = $head;
                $b1 = $b1->next;
            }else{
                $a1->next = $head;
                $a1 = $a1->next;
            }
            $head = $next;
        }

        $a1->next = $b->next;
        return $a->next;
    }
}

$head = [1,4,3,2,5,2];
$n = 3;

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

$res = $solution->partition($node,$n);
print_r($res);