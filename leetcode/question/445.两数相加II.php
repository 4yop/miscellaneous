<?php
//445. 两数相加 II
class ListNode {
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}

class Solution {


    function addTwoNumbers($l1, $l2) {
        $p1 = $l1;
        $p2 = $l2;
        $len1 = 0;
        $len2 = 0;
        while($p1 != NULL || $p2 != NULL){
            if($p1 != NULL){
                $len1++;
                $p1 = $p1->next;
            }
            if($p2 != NULL){
                $len2++;
                $p2 = $p2->next;
            }
        }

        if($len1 > $len2){
            $diff = $len1 - $len2;
            while($diff > 0){
                $t = new ListNode(0);
                $t->next = $l2;
                $l2 = $t;
                $diff--;
            }
        }else if($len2 < $len1){
            $diff = $len2 - $len1;
            while($diff > 0){
                $t = new ListNode(0);
                $t->next = $l1;
                $l1 = $t;
                $diff--;
            }
        }
        $temp = new ListNode(0);
        $curr = $temp;
        while($l1 != NULL || $l2 != NULL){
            $val = $l1->val + $l2->val;echo "$l1->val + $l2->val = $val\n";
            if($val >= 10){
                $curr->val = $curr->val + 1;
                $val -= 10;
            }
            $curr->next = new ListNode($val);
            $curr = $curr->next;
            $l1 = $l1->next;
            $l2 = $l2->next;
        }
        return $temp->next;
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

$l2 = [5,6,4];
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