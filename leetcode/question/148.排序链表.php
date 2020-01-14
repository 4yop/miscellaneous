<?php
//876. 链表的中间结点
class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class Solution {


    function sortList($head) {
        $currentNode = $head;
        $res = NULL;
        while($currentNode !== NULL){
            $next = $currentNode->next;
            $res = $this->insertNode($res,$currentNode);
            $currentNode = $next;
        }
        return $res;
    }

    function insertNode($listNode=NULL,$node){
        if($listNode == NULL){
            return $node;
        }
        $node->next = NULL;
        $currentNode = new ListNode(-1);
        $currentNode->next = $listNode;
        if($node->val <= $currentNode->next->val){
            $node->next = $currentNode->next;
            return $node;
        }
        $flag = false;//是否插入了
        while($currentNode->next !== NULL){
            if($node->val <= $currentNode->next->val){
                $next = $currentNode->next;
                $node->next = $next;
                $currentNode->next = $node;
                $flag = true;
                break;
            }
            $currentNode = $currentNode->next;
        }
        if(!$flag){
            $currentNode->next = $node;
        }
        return $listNode;
    }
}

$head = [4,2,1,3];
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