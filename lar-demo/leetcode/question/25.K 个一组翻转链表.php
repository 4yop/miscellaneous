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
     * @param Integer $k
     * @return ListNode
     */
    function reverseKGroup($head, $k) {

        $list = $head;
        $res = new ListNode(-1);//返回结果的
        $r = $res;

        $temp = null;//保存翻转的

        $i = 0;
        while ($list !== null)
        {

            if ($i == $k)
            {
                while ($r->next !== null)
                {
                    $r = $r->next;
                }
                $r->next = $temp;
                $temp = null;
                $i = 0;

            }//end if i == k

            $next = $list->next;

            $list->next = $temp;
            $temp = $list;



            $list = $next;
            $i++;
        }//end while list != null


        while ($r->next !== null) {
            $r = $r->next;
        }

        $rev = null;

        while($temp !== null) {
            $next = $temp->next;

            $temp->next = $rev;
            $rev = $temp;

            $temp = $next;
        }

        $r->next = $rev;

        return $res->next;
    }



}

$head = [1,2];
$k = 2;

$head = buildListNodeByArr($head);

$solution = new Solution();

$res = $solution->reverseKGroup($head,$k);
print_r($res);