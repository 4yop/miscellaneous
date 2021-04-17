<?php
require_once '../common/base.php';



class Solution {
    function swapNodes($head, $k) {
        $curr = $head;
        $fast = $head;
        $slow = $head;
        $i = 0;
        while($fast !== null)
        {
            if ($i >= $k)
            {
                $slow = $slow->next;
            }
            $i++;
            $fast = $fast->next;
        }
        return $slow;
    }
}

$head = [1,2,3,4,5];
$n = 2;

$head = buildTreeNodeByArr($head);
$solution = new Solution();

$res = $solution->swapNodes($head,$n);
print_r($res);