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

    function __construct() {

    }

    /**
     * Get the value of the index-th node in the linked list. If the index is invalid, return -1.
     * @param Integer $index
     * @return Integer
     */
    function get($index) {
        $i = 0;

        $currentNode = $this->head;
        while($currentNode != NULL){
            if($i == $index){
                return $currentNode;
            }
            $i++;
            $currentNode = $currentNode->next;
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
        if($this->head != NULL){
            $node->next = $this->head;
            $this->head = $node;
        }else{
            $this->head = $node;
        }
        return $this->head;
    }

    /**
     * Append a node of value val to the last element of the linked list.
     * @param Integer $val
     * @return NULL
     */
    function addAtTail($val) {
        $node = new ListNode($val);
        $currentNode = $this->head;
        while($currentNode->next != NULL){
            $currentNode = $currentNode->next;
        }
        $currentNode->next = $node;
        return $this->head;
    }

    /**
     * Add a node of value val before the index-th node in the linked list. If index equals to the length of linked list, the node will be appended to the end of linked list. If index is greater than the length, the node will not be inserted.
     * @param Integer $index
     * @param Integer $val
     * @return NULL
     */
    function addAtIndex($index, $val) {
        $currentNode = $this->head;
        $i = 0;
        $newNode = new ListNode($val);
        $flag = false;
        while($currentNode != NULL){

            if($i == $index){
                $newNode->next =$currentNode->next;
                $currentNode->next = $newNode;
                $flag = true;
                break;
            }
            $i++;
            $currentNode = $currentNode->next;
        }

        if($flag == false){
            $currentNode->next = $newNode;
        }

        return $this->head;
    }

    /**
     * Delete the index-th node in the linked list, if the index is valid.
     * @param Integer $index
     * @return NULL
     */
    function deleteAtIndex($index) {

        $currentNode = new ListNode(-1);
        $currentNode->next = $this->head;
        $i = 0;


        while($currentNode->next != NULL){

            if($i == $index){
                $currentNode->next = $currentNode->next->next;
                return $this->head;
            }
            $i++;
            $currentNode = $currentNode->next;
        }



        return $this->head;
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