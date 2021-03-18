<?php
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
require_once '../common/base.php';
class Solution {

    /**
     * @param ListNode $head
     * @param Integer $left
     * @param Integer $right
     * @return ListNode
     */
    function reverseBetween($head, $left, $right) {

        //0 - (left-1) 这段
        $start = new ListNode(-1);
        $start->next = $head;
        $s = $start;
        $i = 0;
        while ($i < $left-1 && $s->next !== null) {
            $i++;
            $s = $s->next;
        }



        //left - right 这段
        $list2 = new ListNode(-1);
        $list2->next = $s->next;
        $m = $list2;
        while ($i<$right && $m->next  !== null) {
            $i++;
            $m = $m->next;
        }

        //right - 结尾这段
        $end = $m->next;
        $m->next = null;//清除right之后的节点


        $a = $list2->next;
        while ($a != null) {
            $next = $a->next;
            $a->next = $end;
            $end = $a;
            $a = $next;
        }

        $s->next = $end;
        return $start->next;
    }



}

$head = [1,2,3,4,5];$left = 2;
$right = 4;

$head = buildListNodeByArr($head);

$s = new Solution();
$r = $s->reverseBetween($head,$left,$right);
var_dump($r);