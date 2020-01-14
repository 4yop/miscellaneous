<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/28
 * Time: 10:24
 */
//82. 删除排序链表中的重复元素II




class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {

    /**
     * @param ListNode $head
     * @param Integer $n
     * @return ListNode
     */
    function deleteDuplicates($head) {
        $currentNode = new ListNode(-1);
        $currentNode->next = $head;

        while($currentNode->next != NULL){
            if($currentNode->val === $currentNode->next->val){
                $currentNode->next = $currentNode->next->next;

                $bbb = $currentNode;
                while($bbb->val != $currentNode->val && $bbb != NULL){
                    $bbb = $bbb->next;
                }
                $currentNode = $bbb;
            }else{
                $currentNode = $currentNode->next;
            }
        }
        return $head;
    }
}


$head = [1,2,3,3,4,4,5];
$n = 1;

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