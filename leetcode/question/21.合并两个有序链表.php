<?php
// 234. 回文链表
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {

    //迭代
    function mergeTwoLists($l1, $l2) {

        $res = new ListNode(-1);
        $curr = $res;

        while($l1 !== NULL && $l2 !== NULL){
            if($l1->val <= $l2->val){
                $curr->next = $l1;
                $l1 = $l1->next;
            }else{
                $curr->next = $l2;
                $l2 = $l2->next;
            }
            $curr = $curr->next;
        }
        $curr->next = $l1 === NULL ? $l2 : $l1;
        return $res->next;
    }

    //递归
    function mergeTwoLists1($l1,$l2){
        $res = new ListNode(-1);
        $curr = $res;
        $this->helper($l1,$l2,$curr);
        return $res->next;
    }

    function helper(ListNode $l1 = NULL,ListNode $l2 = NULL,ListNode $curr = NULL){

        if($l1 !== NULL && $l2 !== NULL){
            if($l1-> val <= $l2->val){
                $curr->next = $l1;
                $l1 = $l1->next;
            }else{
                $curr->next = $l2;
                $l2 = $l2->next;
            }
            $curr = $curr->next;
            $this->helper($l1,$l2,$curr);
        }else{
            $curr->next = $l1 === NULL ? $l2 : $l1;
        }

    }
}

$head = [1,2,4];
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

$head1 = [1,3,5];
$n = 0;

//生成链表
$node1 = new ListNode($head[0]);
$current = $node1;
$i = 1;
while($i < count($head1)){
    $val = $head1[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}

$solution = new Solution();

$res = $solution->mergeTwoLists1($node,$node1);
var_dump($res);