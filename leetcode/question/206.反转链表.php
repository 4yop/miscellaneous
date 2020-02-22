<?php
// 234. 回文链表
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {

    //迭代
    function reverseList($head) {
        if($head === NULL){
            return NULL;
        }
        $res = NULL;
        $currentNode = $head;

        while ($currentNode !== NULL){
            $next = $currentNode->next;

            $currentNode->next = $res;
            $res = $currentNode;

            $currentNode = $next;
        }
        return $res;
    }

    //递归
    public $res = NULL;
    function reverseList1($head){
        $this->helper($head);
        return $this->res;
    }

    function helper($currentNode = NULL){
        if($currentNode !== NULL){
            $next = $currentNode->next;
            $currentNode->next = $this->res;
            $this->res = $currentNode;
            $currentNode = $next;
            $this->helper($currentNode);
        }else{
            return;
        }
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

$res = $solution->reverseList1($node);
var_dump($res);