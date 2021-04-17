<?php






class MyStack {
    /**
     * Initialize your data structure here.
     */
    public $queue = [];
    function __construct() {

    }

    /**
     * Push element x onto stack.
     * @param Integer $x
     * @return NULL
     */
    function push($x) {
        array_push($this->queue,$x);
    }

    /**
     * Removes the element on top of the stack and returns that element.
     * @return Integer
     */
    function pop() {
        return array_pop($this->queue);
    }

    /**
     * Get the top element.
     * @return Integer
     */
    function top() {
        return end($this->queue);
    }

    /**
     * Returns whether the stack is empty.
     * @return Boolean
     */
    function empty() {
        return count($this->queue) < 1;
    }
}

/**
 * Your MyStack object will be instantiated and called as such:
 * $obj = MyStack();
 * $obj->push($x);
 * $ret_2 = $obj->pop();
 * $ret_3 = $obj->top();
 * $ret_4 = $obj->empty();
 * ["MyStack","push","push","top","pop","empty"]
[[],[1],[2],[],[],[]]
 *
[null,null,null,2,2,false]
 */
$x = 1;
$r[] = $obj = new MyStack();
$r[] = $obj->push(1);
$r[] = $obj->push(2);
$r[] = $obj->top();
$r[] = $obj->pop();
$r[] = $obj->empty();
print_r($r);