<?php

//82. 删除排序链表中的重复元素II

require_once '../common/base.php';


//class ListNode {
//    public $val = 0;
//    public $next = null;
//    function __construct($val) { $this->val = $val; }
//}

class Solution {

    /**
     * @param ListNode $head
     * @param Integer $n
     * @return ListNode
     */
    function deleteDuplicates($head) {

    }
}


$head = [1,2,3,3,4,4,5];


//生成链表

$node = buildListNodeByArr($head);

$solution = new Solution();

$res = $solution->deleteDuplicates($node);
print_r($res);