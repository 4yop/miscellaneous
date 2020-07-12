<?php
//876. 链表的中间结点
use fast\Tree;

class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {


    function mergeTwoLists($l1, $l2) {
        $res = new ListNode(-1);
        $p = $res;
        while($l1 !== null){
            if($p->next !== null) {
                while ($p->next !== null) {
                    if ($p->val >= $l1->val) {

                        continue;
                    }
                    $p = $p->next;
                }
            }else{
                $p->next = $l1;
            }
            $l1 = $l1->next;
        }

        return $res->next;
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