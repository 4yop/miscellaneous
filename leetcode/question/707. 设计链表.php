<?php
//707. 设计链表
class ListNode {
  public $val = 0;
  public $next = null;
  function __construct($val) { $this->val = $val; }
}

class MyLinkedList
{

    public $head;
    private $size;

    /*
     * Initialize your data structure here.
     */
    function __construct()
    {
        $this->head = new ListNode(0);
        $this->size = 0;
    }

    /**
     * Get the value of the index-th node in the linked list. If the index is invalid, return -1.
     * @param Integer $index
     * @return Integer
     */
    function get($index)
    {
        $p = $this->head;
        $i = 0;
        while ($i <= $index) {
            $p = $p->next;
            if ($p == null) {
                return -1;
            }
            $i++;
        }

        return $p->val;
    }

    /**
     * Add a node of value val before the first element of the linked list. After the insertion, the new node will be the first node of the linked list.
     * @param Integer $val
     * @return NULL
     */
    function addAtHead($val)
    {
        $new_node = new ListNode($val);
        $new_node->next = $this->head->next;
        $this->head->next = $new_node;
        $this->size++;
        return null;
    }

    /**
     * Append a node of value val to the last element of the linked list.
     * @param Integer $val
     * @return NULL
     */
    function addAtTail($val)
    {
        $p = $this->head;
        while ($p->next != null) {
            $p = $p->next;
        }

        $new_node = new ListNode($val);
        $p->next = $new_node;
        $this->size++;
        return null;
    }

    /**
     * Add a node of value val before the index-th node in the linked list. If index equals to the length of linked list, the node will be appended to the end of linked list. If index is greater than the length, the node will not be inserted.
     * @param Integer $index
     * @param Integer $val
     * @return NULL
     */
    //注意三种情况，1.index<size，2.index>size 3.index=size
    function addAtIndex($index, $val)
    {
        $p = $this->head;
        $i = 0;
        if ($index == $this->size) {
            //index==size,直接放在链表末尾
            $this->addAtTail($val);
        } else {

            while ($i < $index) {
                $p = $p->next;
                //非正常，index>size,直接返回
                if ($p == null) {
                    return;
                }
                $i++;
            }
            //正常情况，获得index前面的指针，然后插入
            $new_node = new ListNode($val);
            $new_node->next = $p->next;
            $p->next = $new_node;
            $this->size++;
        }

        return;
    }

    /**
     * Delete the index-th node in the linked list, if the index is valid.
     * @param Integer $index
     * @return NULL
     */
    //删除操作，注意关键节点，index=size 的时候，
    function deleteAtIndex($index)
    {
        $p = $this->head;
        $i = 0;
        while ($i < $index) {
            $p = $p->next;
            if ($p == null) {
                return;
            }
            $i++;
        }

        //index=size的时候 p->next为null
        if($p->next == null){
            return;
        }

        $p->next = $p->next->next;
        $this->size--;
        return;
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
 */



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