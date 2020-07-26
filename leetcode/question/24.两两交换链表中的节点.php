<?php
//876. 链表的中间结点
class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {

    //迭代
    function swapPairs($head) {
        $listNode = new ListNode(-1);
        $listNode->next = $head;
        $prevNode = $listNode;
        while ($head !== null && $head->next !== null ) {
            $firstNode = $head;
            $secondNode = $head->next;
            $prevNode->next = $secondNode;
            $firstNode->next = $secondNode->next;
            $secondNode->next = $firstNode;
            $prevNode = $firstNode;
            $head = $firstNode->next;
        }
        return $listNode->next;
    }

    //递归
    function swapPairs1($head) {
        if($head === null || $head->next === null ){
            return null;
        }
        $firstNode = $head;
        $secondNode = $head->next;
        $firstNode->next = $this->swapPairs1($secondNode->next);
        $secondNode->next = $firstNode;

        return $secondNode;
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

$res = $solution->swapPairs1($node);
print_r($res);