<?php
//707. 设计链表
class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class MyLinkedList {
    /**
     * Initialize your data structure here.
     */
    public $linkedList = NULL;
    public $total = 0;
    function __construct() {

    }

    /**
     * Get the value of the index-th node in the linked list. If the index is invalid, return -1.
     * @param Integer $index
     * @return Integer
     */
    function get($index) {
        if($index < $this->total){
            $currentNode = $this->linkedList;
            $i = 0;
            while($currentNode !== NULL){
                if($i == $index){
                    return $currentNode->val;
                }
                $i++;
                $currentNode = $currentNode->next;
            }
        }
        return -1;
    }

    /**
     * Add a node of value val before the first element of the linked list. After the insertion, the new node will be the first node of the linked list.
     * @param Integer $val
     * @return NULL
     */
    function addAtHead($val) {
        $node = new ListNode($val);
        $node->next = $this->linkedList;
        $this->linkedList = $node->next;
        $this->total++;
    }

    /**
     * Append a node of value val to the last element of the linked list.
     * @param Integer $val
     * @return NULL
     */
    function addAtTail($val) {
        $node = new ListNode($val);
        $currentNode = $this->linkedList;
        while($currentNode !== NULL){
            $currentNode = $currentNode->next;
        }
        $currentNode = $node;
        $this->total++;
    }

    /**
     * Add a node of value val before the index-th node in the linked list. If index equals to the length of linked list, the node will be appended to the end of linked list. If index is greater than the length, the node will not be inserted.
     * @param Integer $index
     * @param Integer $val
     * @return NULL
     */
    function addAtIndex($index, $val) {
        $node = new ListNode($val);
        if($index <= 0){
            $node->next = $this->linkedList;
            $this->linkedList = $node;
        }else{
            $currentNode = new ListNode(-1);
            $currentNode->next = $this->linkedList;
            $flag = false;//是否加了
            $i = 0;
            while($currentNode->next !== NULL ){
                if($i == $index){
                    $next = $currentNode->next;
                    $node->next = $next;
                    $currentNode->next = $node;
                    return;
                }
                $i++;
                $currentNode = $currentNode->next;
            }
            if($this->total == $index){
                $currentNode->next = $node;
            }
        }

    }

    /**
     * Delete the index-th node in the linked list, if the index is valid.
     * @param Integer $index
     * @return NULL
     */
    function deleteAtIndex($index) {
        if($index >= $this->total){
            return;
        }
        $currentNode = new ListNode(-1);
        $currentNode->next = $this->linkedList;
        $i = 0;
        while($currentNode->next !== NULL){
            if($i == $index){
                $currentNode->next = $currentNode->next->next;
                $this->total--;
                return;
            }
            $i++;
            $currentNode = $currentNode->next;
        }
    }
}

/**
 * Your MyLinkedList object will be instantiated and called as such:
 * $obj = MyLinkedList();
 * $ret_1 = $obj->get($index);
 * $obj->addAtHead($val);
 * $obj->addAtTail($val);
 * $obj->addAtIndex($index, $val);
 * $obj->deleteAtIndex($index);
 **/

$obj = new MyLinkedList();
$res = $obj->addAtHead(1);
$res = $obj->addAtHead(2);
$res = $obj->addAtTail(3);
$res = $obj->addAtTail(4);

print_r($obj->addAtIndex(2,100));
print_r($obj->deleteAtIndex(1,100));