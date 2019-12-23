<?php

/**
 * 链表结构
 * tip:其实就是递归对象，类型于多级分类
 */
class ListNode {
    public $val = NULL;
    public $next = NULL;

    public function __construct($val = NULL) {
        $this->val = $val;
    }
}

class LinkedList {
    public $listNode = NULL;

    /**末尾插入结点
     * @param ListNode|NULL $node 结点
     */
    public function insert(ListNode $node = NULL){
        if($this->listNode === NULL){
            $this->listNode = $node;
        }else{
            $currentNode = $this->listNode;
            while($currentNode !== NULL){
                if($currentNode->next === NULL){
                    $currentNode->next = $node;
                    break;
                }
                $currentNode = $currentNode->next;
            }

        }
        return $this->listNode;
    }

    /**删除一个结点根据val值
     * @param $val
     */
    public function del($val){
        $currentNode = new ListNode();
        $currentNode->next = $this->listNode;
        $flag = false;//是否有删除了
        while($currentNode->next !== NULL){
            if($currentNode->next->val === $val){
                $currentNode->next = $currentNode->next->next;
                $flag = true;
                break;
            }
            $currentNode = $currentNode->next;
        }
        return $flag;
    }

    /**删除所有结点根据val值
     * @param $val
     * @return int
     */
    public function remove($val){
        $currentNode = new ListNode();
        $currentNode->next = $this->listNode;
        $count = 0;
        while($currentNode->next != NULL){
            //echo "{$currentNode->next->val} === {$val}\n";
            if($currentNode->next->val == $val){
                $currentNode->next = $currentNode->next->next;
                $count++;
                continue;
            }
            $currentNode = $currentNode->next;


        }
        return $count;
    }

    /**链表反转
     * @return null
     */
    public function reverse(){
        $currentNode = $this->listNode;
        $tempNode = NULL;
        while($currentNode !== NULL){
            $next = $currentNode->next;
            $currentNode->next = $tempNode;
            $tempNode = $currentNode;
            $currentNode = $next;
        }
        $this->listNode = $tempNode;
        return $this->listNode;
    }

    /**排序
     * @param string $order asc 从小到大 desc从大到小
     * @return null
     */
    public function order($order = 'asc'){
        $currentNode = $this->listNode;
        $tempNode = NULL;
        while($currentNode !== NULL){
            $next = $currentNode->next;
            $tempNode = $this->add($tempNode,$currentNode);
            echo "---".$currentNode->val."\n";
            print_r($tempNode);
            $currentNode = $next;
        }
        return $tempNode;
    }

    /**结点里加入一个结点
     * @param ListNode|NULL $listNode
     * @param null $node
     * @return ListNode
     */
    public function add(ListNode $listNode = NULL,$node = NULL){
        if($node === NULL){
            return $listNode;
        }
        $node->next = NULL;
        if($listNode === NULL){
            return $node;
        }



        $currentNode = new ListNode();
        $currentNode->next = $listNode;
        $flag = false;
        while($currentNode->next !== NULL){

            if($node->val <= $currentNode->next->val){
                $nextnext = $currentNode->next->next;
                $node->next = $nextnext;
                $currentNode->next = $node;
                $flag = true;
                break;
            }

            $currentNode = $currentNode->next;
        }
        if($flag === false && $currentNode->next === NULL){
            $currentNode->next = $node;
        }
        return $listNode;
    }

    /**
     *显示到第几位 -1就全部显示
     */
    public function display($index = -1){
        $currentNode = $this->listNode;
        $i = 0;
        while($currentNode !== NULL){
            echo "listNode[$i]:{$currentNode->val}\n";
            if($index != -1 && $i == $index){
                break;
            }
            $i++;
            $currentNode = $currentNode->next;
        }
    }
}


$linkedList = new LinkedList();

$linkedList->insert(new ListNode(3));
$linkedList->insert(new ListNode(1));
$linkedList->insert(new ListNode(4));
$linkedList->insert(new ListNode(2));


$r = $linkedList->order();
//var_dump($r);
//$linkedList->display();
