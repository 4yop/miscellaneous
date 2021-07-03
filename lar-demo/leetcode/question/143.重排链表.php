<?php
//143. 重排链表
use leetcode\common\{Base,ListNode};

class Solution {


    function reorderList($head) {
        $node = $head;
        $i = 0;
        while ($node !== null)
        {
            echo "第{$i}\n";
            echo $node->val."\n";
            $next = $node->next;
            $t = $next;
            while ($t->next != null)
            {
                $t = $t->next;
            }
            $node->next = $t;


            $node->next->next = $next;

            $node = $next;

            $i++;
        }
        return $head;
    }
}

$arr = [1,2,3,4,5,6];


$head = Base::buildListNodeByArr($arr);

$solution = new Solution();

$res = $solution->reorderList($head);
//print_r($res);
