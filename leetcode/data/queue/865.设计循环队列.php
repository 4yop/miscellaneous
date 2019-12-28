<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/27
 * Time: 9:50
 */

/**
 * Class MyCircularQueue
 * 设计你的循环队列实现。 循环队列是一种线性数据结构，其操作表现基于 FIFO（先进先出）原则并且队尾被连接在队首之后以形成一个循环。它也被称为“环形缓冲器”。

循环队列的一个好处是我们可以利用这个队列之前用过的空间。在一个普通队列里，一旦一个队列满了，我们就不能插入下一个元素，即使在队列前面仍有空间。但是使用循环队列，我们能使用这些空间去存储新的值。

你的实现应该支持如下操作：

MyCircularQueue(k): 构造器，设置队列长度为 k 。
Front: 从队首获取元素。如果队列为空，返回 -1 。
Rear: 获取队尾元素。如果队列为空，返回 -1 。
enQueue(value): 向循环队列插入一个元素。如果成功插入则返回真。
deQueue(): 从循环队列中删除一个元素。如果成功删除则返回真。
isEmpty(): 检查循环队列是否为空。
isFull(): 检查循环队列是否已满。

 */


class MyCircularQueue {
    /**
     * Initialize your data structure here. Set the size of the queue to be k.
     * @param Integer $k
     */
    private $length = 0;
    private $data = [];
    function __construct($k) {
        $this->length = $k;
    }

    /**
     * Insert an element into the circular queue. Return true if the operation is successful.
     * @param Integer $value
     * @return Boolean
     */
    function enQueue($value) {
        if($this->isFull() ){
            return false;
        }
        if(array_push($this->data,$value)){
           return true;
        }
        return false;
    }

    /**
     * Delete an element from the circular queue. Return true if the operation is successful.
     * @return Boolean
     */
    function deQueue() {
        if(array_shift($this->data) !== NULL){
            return true;
        }
        return false;
    }

    /**
     * Get the front item from the queue.
     * @return Integer
     */
    function Front() {
        reset($this->data);
        return !$this->isEmpty() ? current($this->data) : -1;
    }

    /**
     * Get the last item from the queue.
     * @return Integer
     */
    function Rear() {
        reset($this->data);
        return !$this->isEmpty() ? end($this->data) : -1;
    }

    /**
     * Checks whether the circular queue is empty or not.
     * @return Boolean
     */
    function isEmpty() {
        return empty($this->data);
    }

    /**
     * Checks whether the circular queue is full or not.
     * @return Boolean
     */
    function isFull() {
        if(count($this->data) >= $this->length){
            return true;
        }
        return false;
    }
}

/**
 *
 *
 *
 * Your MyCircularQueue object will be instantiated and called as such:
 * $obj = MyCircularQueue($k);
 * $ret_1 = $obj->enQueue($value);
 * $ret_2 = $obj->deQueue();
 * $ret_3 = $obj->Front();
 * $ret_4 = $obj->Rear();
 * $ret_5 = $obj->isEmpty();
 * $ret_6 = $obj->isFull();
 */

class MyCircularQueue1 {

    private $data = [];
    private $head=0;
    private $tail;
    private $size;

        /** Initialize your data structure here. Set the size of the queue to be k. */
    public function __construct($k) {
        $this->data = [];
        $this->head = -1;
        $this->tail = -1;
        $this->size = $k;
    }

    /** Insert an element into the circular queue. Return true if the operation is successful. */
    public function enQueue($value) {
        if ($this->isFull() == true) {
            return false;
        }
        if ($this->isEmpty() == true) {
            $this->head = 0;
        }
        $this->tail = ($this->tail + 1) % $this->size;
        $this->data[$this->tail] = $value;
        return true;
    }

    /** Delete an element from the circular queue. Return true if the operation is successful. */
    public function deQueue() {
        if ($this->isEmpty() == true) {
            return false;
        }
        if ($this->head == $this->tail) {
            $this->head = -1;
            $this->tail = -1;
            return true;
        }
        $this->head = ($this->head + 1) % $this->size;
        return true;
    }

    /** Get the front item from the queue. */
    public function Front() {
        if ($this->isEmpty() == true) {
            return -1;
        }
        return $this->data[$this->head];
    }

    /** Get the last item from the queue. */
    public function Rear() {
        if ($this->isEmpty() == true) {
            return -1;
        }
        return $this->data[$this->tail];
    }

    /** Checks whether the circular queue is empty or not. */
    public function isEmpty() {
        return $this->head == -1;
    }

    /** Checks whether the circular queue is full or not. */
    public function isFull() {
        return (($this->tail + 1) % $this->size) == $this->head;
    }
}

/**
 * Your MyCircularQueue object will be instantiated and called as such:
 * MyCircularQueue obj = new MyCircularQueue(k);
 * boolean param_1 = obj.enQueue(value);
 * boolean param_2 = obj.deQueue();
 * int param_3 = obj.Front();
 * int param_4 = obj.Rear();
 * boolean param_5 = obj.isEmpty();
 * boolean param_6 = obj.isFull();
 */