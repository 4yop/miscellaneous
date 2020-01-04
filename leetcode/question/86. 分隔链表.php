<?php

require_once "../../learn/data/linked-list.php";
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution {

    /**
     * @param ListNode $head
     * @param Integer $x
     * @return ListNode
     */
    function partition($head, $x) {

    }
}

$arr = [1,4,3,2,5,2];
$head = (new LinkedList())->create($arr);
$x = 3;

$res = (new Solution())->partition($head,$x);
var_dump($res);

