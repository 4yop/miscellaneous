<?php
// 234. 回文链表
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {

    /**
     * @param ListNode $head
     * @return Integer[]
     */
    function nextLargerNodes($head) {
        $res = [];
        $i = 0;
        $p1 = $head;
        while($p1 !== null){
            $res[$i] = 0;
            $p2 = $p1->next;
            while($p2 !== null){
                if($p2->val > $p1->val){
                    $res[$i] = $p2->val;
                    break;
                }
                $p2 = $p2->next;
            }
            $i++;
            $p1 = $p1->next;
        }
        return $res;
    }
}

$head = [1,7,5,1,9,2,5,1];
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

$res = $solution->nextLargerNodes($node);
print_r($res);