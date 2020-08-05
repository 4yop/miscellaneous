<?php



  class ListNode {
      public $val = 0;
      public $next = null;
      function __construct($val) { $this->val = $val; }
  }

class Solution {

    /**
     * @param ListNode $head
     * @return ListNode
     */
    //哈希表
    function removeDuplicateNodes($head) {
        $node = $head;
        $hash = [ $node->val => 1 ];
        while($node !== null && $node->next !== null){
            if ( isset($hash[$node->next->val])  )
            {
                $node->next = $node->next->next;
            }
            else
            {
                $hash[$node->next->val] = 1;
                $node = $node->next;
            }
        }
        return $head;
    }
    //二重循环 超时
    function removeDuplicateNodes1($head) {
        $p1 = $head;
        while($p1 !== null)
        {
            $p2 = $p1;
            while($p2->next !== null)
            {

                if($p2->next->val === $p1->val)
                {
                    $p2->next = $p2->next->next;
                }
                else
                {
                    $p2 = $p2->next;
                }
            }
            $p1 = $p1->next;
        }
        return $head;
    }
}
$head = [1, 2, 3, 3, 2, 1];
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

$res = $solution->removeDuplicateNodes1($node);
print_r($res);