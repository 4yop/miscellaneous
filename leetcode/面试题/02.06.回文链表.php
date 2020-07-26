<?php



  class ListNode {
      public $val = 0;
      public $next = null;
      function __construct($val) { $this->val = $val; }
  }

class Solution {

    /**
     * @param ListNode $head
     * @param Integer $k
     * @return Integer
     */
    function isPalindrome($head) {
        $stack = [];
        $p = $head;
        while ($p !== null) {
            array_push($stack,$p->val);
            $p = $p->next;
        }
        while (!empty($stack)) {
            if(array_pop($stack) != $head->val){
                return false;
            }
            $head = $head->next;
        }
        return true;
    }
}
$head = [1,0,1];
$n = 3;

//生成链表
$node = new ListNode($head[0]);
$current = $node;
$i = 1;
while($i < count($head)){
    $val = $head[$i++];
    $current->next = new ListNode($val);
    $current = $current->next;
}

$solution = new Solution();

$res = $solution->isPalindrome($node);
var_dump($res);