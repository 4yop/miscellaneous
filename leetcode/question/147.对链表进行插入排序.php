<?php
// 234. 回文链表
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {


    function insertionSortList($head) {
        $listNode = new ListNode(-1);

        $curr = $head;

        while($curr !== NULL){
            $next = $curr->next;

            $p = $listNode;
            $flag = false;
            while($p->next !== NULL){
                $Pnext = $p->next;
                if($p->next->val >= $curr->val){
                    $p->next = $curr;
                    $p->next->next = $Pnext;
                    $flag = true;
                    break;
                }
                $p = $Pnext;
            }
            if($flag===false){
                $Pnext = $p->next;
                $p->next = $curr;
                $p->next->next = $Pnext;
            }

            $curr = $next;
        }
        return $listNode->next;
    }


}

$head = [4,2,1,3,5];
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

$res = $solution->insertionSortList($node);
print_r($res);