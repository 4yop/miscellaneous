<?php
//445. 两数相加 II
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {


    function addTwoNumbers($l1, $l2) {
        $a1 = [];
        $a2 = [];
        while($l1 !== NULL){
            $a1[] = $l1->val;
            $l1 = $l1->next;
        }
        while($l2 !== NULL){
            $a2[] = $l2->val;
            $l2 = $l2->next;
        }
        $res = NULL;
        $ten = 0;//满10就变1
        while(!empty($a1) || !empty($a2) || $ten){
            $sum = $ten;
            if(!empty($a1)){
                $sum += array_pop($a1);
            }
            if(!empty($a2)){
                $sum += array_pop($a2);
            }
            if($sum >= 10){
                $sum -= 10;
                $ten = 1;
            }else{
                $ten = 0;
            }
            $node = new ListNode($sum);
            $node->next = $res;
            $res = $node;
        }
        return $res;
    }
}

$l1 = [7,2,4,3];
$n = 0;

//生成链表
$node = new ListNode($l1[0]);
$current = $node;
$i = 1;
while($i < count($l1)){
    $val = $l1[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}

$l2 = [7,5,6,4];
$n = 0;

//生成链表
$node2 = new ListNode($l2[0]);
$current = $node2;
$i = 1;
while($i < count($l2)){
    $val = $l2[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}


$solution = new Solution();

$res = $solution->addTwoNumbers($node,$node2);
print_r($res);