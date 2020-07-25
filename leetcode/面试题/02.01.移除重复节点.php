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
    //双指针
    function kthToLast($head, $k) {
        $p1= $head;
        $p2 = $head;
        $i = 0;
        while($p1 !== null){
            if($i >= $k){
                $p2 = $p2->next;
            }
            $p1 = $p1->next;
            $i++;
        }
        return $p2->val;
    }
}
$head = [1,2,3,4,5];
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

$res = $solution->kthToLast($node,2);
print_r($res);