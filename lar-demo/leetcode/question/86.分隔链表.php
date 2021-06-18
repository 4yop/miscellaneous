<?php

use leetcode\common\ListNode;
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
class Solution {

    /**时间复杂度 ：O(n)
     * 空间复杂度：0(1)
     * @param ListNode $head
     * @param Integer $x
     * @return ListNode
     */
    function partition($head, $x) {
        $big = new ListNode(-1);
        $b = $big;
        $small = new ListNode(-1);
        $s = $small;
        $node = $head;
        while ($node !== null)
        {
            if ($node->val < $x)
            {
                $s->next = $node;
                $s = $s->next;
            }else
            {
                $b->next = $node;
                $b = $b->next;
            }
            $node = $node->next;
        }
        $b->next = null;
        $s->next = $big->next;
        return $small->next;
    }
}


$s = new Solution();

$x = 2;

$arr = [2,1];

//生成链表
$head = (new \leetcode\common\Base())->buildListNodeByArr($arr);

$r = $s->partition($head,$x);

var_dump($r);
