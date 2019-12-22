<?php
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class ListNode {
     public $val = 0;
     public $next = null;
     function __construct($val) { $this->val = $val; }
 }
class Solution {


    function mergeTwoLists($l1, $l2) {
        if($l1 === NULL){
            return $l2;
        }
        if($l2 === NULL){
            return $l1;
        }
        $current1 = $l1;
        $current2 = $l2;
        while ($current2 !== NULL){
            $next2 = $current2->next;
            $l1 = $this->insertNode($l1,$current2);
            $current2 = $next2;
        }
        return $l1;
    }

    /**
     * @param $listNode 总节点
     * @param $node 待插入的一节点
     */
    function insertNode($listNode,$node){
        $curr = new ListNode(-1);
        $curr->next = $listNode;

        $node->next = NULL;
        if($node->val <= $curr->next->val){
            $node->next = $curr->next;
            return $node;
        }


        $flag = false;//是否已经插入了
        while($curr->next !== NULL){
            if($node->val <= $curr->next->val){

                $next = $curr->next;
                $node->next = $next;
                $curr->next = $node;

                $flag = true;
                break;
            }
            $curr = $curr->next;
        }
        if(!$flag){
            $curr->next = $node;
        }
        return $listNode;
    }
}

$head = [1,2,4];


//生成链表
$node = new ListNode($head[0]);
$current = $node;
$i = 1;
while($i < count($head)){
    $val = $head[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}

$l1 = $node;

$head = [1,3,4];

//生成链表
$node = new ListNode($head[0]);
$current = $node;
$i = 1;
while($i < count($head)){
    $val = $head[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}

$l2 = $node;
$s = new Solution();
$res= $s->mergeTwoLists($l1,$l2);
//$res= $s->insertNode($l1,$l2);
var_dump($res);
