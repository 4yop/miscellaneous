<?php
class MinStack {
    /**
     * initialize your data structure here.
     */
    private $data = [];
    function __construct() {

    }

    /**
     * @param Integer $x
     * @return NULL
     */
    function push($x) {
        array_push($this->data,$x);
    }

    /**
     * @return NULL
     */
    function pop() {
        array_pop($this->data);
    }

    /**
     * @return Integer
     */
    function top() {
        reset($this->data);
        return end($this->data);
    }

    /**
     * @return Integer
     */
    function getMin() {
        return min($this->data);
    }
}

/**
 * Your MinStack object will be instantiated and called as such:
 * $obj = MinStack();
 * $obj->push($x);
 * $obj->pop();
 * $ret_3 = $obj->top();
 * $ret_4 = $obj->getMin();
 */










