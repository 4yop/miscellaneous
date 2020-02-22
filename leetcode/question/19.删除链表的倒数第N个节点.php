<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/28
 * Time: 10:24
 */
//删除链表的倒数第N个节点




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
    function removeNthFromEnd($head, $n) {

        $currentNode = $head;
        $i = 0;
        while($currentNode != NULL){
            $i++;
            $currentNode = $currentNode->next;
        }


        $index = $i - $n + 1;
        $curr = new ListNode(-1);
        $curr->next = $head;
        $j = 1;
        if($j == $index){
            return $head->next;
        }else{
            while($curr->next != NULL){

                if($j == $index){
                    $curr->next = $curr->next->next;
                    break;
                }
                $j++;
                $curr = $curr->next;
            }
        }

        return $head;
    }
}


$head = [1];
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

$res = $solution->removeNthFromEnd($node,$n);
print_r($res);