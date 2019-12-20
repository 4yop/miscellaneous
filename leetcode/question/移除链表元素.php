<?php
//203. 移除链表元素
class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {


    function removeElements($head, $val) {
        $listNode = new ListNode('xxx');
        $listNode->next = $head;
        $currentNode = $listNode;
        while($currentNode != NULL){
            if($val === $currentNode->next->val ){
                $currentNode->next = $currentNode->next->next;
            }else{
                $currentNode = $currentNode->next;
            }

        }
        return $listNode->next;
    }
}

$head = [1,9,9,9,9,9,9,9];
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

$res = $solution->removeElements($node,$n);
print_r($res);