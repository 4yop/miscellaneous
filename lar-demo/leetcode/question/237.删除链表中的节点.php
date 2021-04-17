<?php
//删除链表中的节点
class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {


    function deleteDuplicates($head,$n) {
        $currentNode = $head;
        $flag = false;
        while($currentNode != NULL && $currentNode->next != NULL){
            if($currentNode->val == $n){
                $flag = true;
                break;
            }
            $currentNode = $currentNode->next;

        }
        if($flag){
            $currentNode->next = $currentNode->next->next;
        }
        return $head;
    }
}

$head = [4,5,1,9];
$n = 5;

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

$res = $solution->deleteDuplicates($node,$n);
print_r($res);