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
use leetcode\common\Base;
use leetcode\common\ListNode;

class Solution {

    /**
     * @param ListNode $head
     * @param Integer $k
     * @return ListNode
     */
    function reverseKGroup($head, $k) {
        $arr = [];
        $list = new ListNode(-1);
        $list->next = $head;
        $node = $list;
        $i = 0;
        $index = 0;
        while ($node->next !== null)
        {
            if ($i == $k)
            {
                $index++;
                $i = 0;
            }
            $arr[$index][] = $node->next->val;
            $node = $node->next;
            $i++;
        }

        $temp = new ListNode(-1);
        $t = $temp;

        foreach ($arr as $value)
        {
            for ($i = count($value) - 1;$i >= 0;$i--)
            {
                $t->next = new ListNode($value[$i]);
                $t = $t->next;
            }
        }
        return $temp->next;
    }



}

$head = [1,2,3,4,5];
$k = 2;

$head = (new Base)->buildListNodeByArr($head);

$solution = new Solution();

$res = $solution->reverseKGroup($head,$k);
print_r($res);
