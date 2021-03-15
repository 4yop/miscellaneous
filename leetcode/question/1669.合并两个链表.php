<?php

require_once '../common/base.php';

class Solution {


    function mergeInBetween($list1, $a, $b, $list2) {
        $end = new ListNode(-1);//找 (b-end) 那块
        $end->next = $list1;
        $e = $end;


        $start = new ListNode(-1);//找 [0-a)那块
        $start->next = $list1;
        $s = $start;
        while ($i <= $b)
        {
            if ($i < $a) {
                $s = $s->next;
            }
            $e = $e->next;
            $i++;
        }

        //拼凑起来  [0-a) + list2 + (b-end)
        $l2 = new ListNode(-1);
        $l2->next = $list2;
        $n2 = $l2;
        while ($n2->next !== null) {
            $n2 = $n2->next;
        }
        $n2->next = $e->next;
        $s->next = $l2->next;

        return $start->next;
    }
}

$list1 =  [0,1,2,3,4,5];
$a = 3;
$b = 4;

$list2 = [1000000,1000001,1000002];

$list1 = buildListNodeByArr($list1);
$list2 = buildListNodeByArr($list2);
$solution = new Solution();
$res = $solution->mergeInBetween($list1, $a, $b, $list2);
print_r($res);