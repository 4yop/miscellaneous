<?php
//876. 链表的中间结点
use fast\Tree;

class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {


    function rotateRight($head, $k) {

        if($head==null) return null;
        if($head->next == null) return $head;
        $tmp = $head;
        for($n=1;$tmp->next != null;$n++){
            $tmp = $tmp->next;
        }
        $tmp->next = $head;

        $tmp2 = $head;
        for($i=0;$i<$n-fmod($k,$n)-1;$i++){
            $tmp2 = $tmp2->next;
        }
        $new_node = $tmp2->next;
        $tmp2->next = null;
        return $new_node;
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

$res = $solution->rotateRight($node,2);
print_r($res);