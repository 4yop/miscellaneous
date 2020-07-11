<?php


class Solution {

    /**
     * @param ListNode $head
     * @param Integer $k
     * @return ListNode
     */
    //双指针
    function getKthFromEnd($head, $k) {
        $fast = $head;
        $slow = $head;
        for($i = 0;$i < $k;$i++){
            $fast = $fast->next;
        }
        while($fast !== null){
            $slow = $slow->next;
            $fast = $fast->next;
        }
        return $slow;
    }
}