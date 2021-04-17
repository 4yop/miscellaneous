<?php
//删除排序链表中的重复元素

class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {


    function deleteDuplicates($head) {
        $currentNode = $head;
        while($currentNode != NULL && $currentNode->next != NULL){
            if($currentNode->val == $currentNode->next->val){
                $currentNode->next = $currentNode->next->next;

            }else{
                $currentNode = $currentNode->next;
            }

        }
        return $head;
    }
}

$head = [0,0,0,0,0];


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

$res = $solution->deleteDuplicates($node);
print_r($res);