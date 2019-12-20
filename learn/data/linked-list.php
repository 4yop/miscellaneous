<?php

/**
 * 链表结构
 * tip:其实就是递归对象，类型于多级分类
 */
class ListNode {
    public $data = NULL;
    public $next = NULL;

    public function __construct($data = NULL) {
        $this->data = $data;
    }
}

class LinkedList {
    private $_firstNode = NULL;
    private $_totalNodes = 0;

    public function insert($data = NULL) {
        $newNode = new ListNode($data);

        if ($this->_firstNode === NULL) {
            $this->_firstNode = &$newNode;
        } else {
            $currentNode = $this->_firstNode;
            while ($currentNode->next !== NULL) {
                $currentNode = $currentNode->next;
            }
            $currentNode->next = $newNode;
        }
        $this->_totalNode++;
        return TRUE;
    }

    public function display() {
        echo "Total book titles: ".$this->_totalNode."\n";
        $currentNode = $this->_firstNode;
        while ($currentNode !== NULL) {
            echo $currentNode->data . "\n";
            $currentNode = $currentNode->next;
        }
    }
    /**
     * 模拟链表
     */

    public function analog(){
        $data = [];
        $right = [];

        fwrite(STDOUT,'输入多少个数:');
        $n = intval(fgets(STDIN));

        for($i = 0;$i < $n;$i++){
            fwrite(STDOUT,"输入data[{$i}]的值:");
            $data[$i] = intval(fgets(STDIN));
        }

        for($i = 0;$i < $n;$i++){

            $right[$i] = $i != $n - 1 ? $i + 1 : -1;

        }
        //插入
        $n++;
        fwrite(STDOUT,"输入data[".($n-1)."]的值:");
        $data[$n-1] = intval(fgets(STDIN));

        $t = 0;
        while($t != -1){
            if($data[$right[$t]] > $data[$n-1]){
                $right[$n-1] = $right[$t];
                $right[$t] = $n - 1;
                break;
            }
            $t = $right[$t];
        }


        //输入链表的所有值
        $t = 0;
        while($t != -1){
            echo $data[$t]."\t";
            $t = $right[$t];
        }
        echo "\n";

        print_r($data);
        print_r($right);
    }
}
$linked_list = new LinkedList();
//$linked_list->insert(1);
//$linked_list->insert(2);
//
//$linked_list->insert(4);
//$linked_list->insert(3);
//$linked_list->display();

$linked_list->analog();
