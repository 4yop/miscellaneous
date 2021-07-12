<?php

class MyQueue {
    public $data = [];
    /**
     * Initialize your data structure here.
     */
    function __construct() {

    }

    /**
     * Push element x to the back of queue.
     * @param Integer $x
     * @return NULL
     */
    function push($x) {
        array_push($this->data,$x);
    }

    /**
     * Removes the element from in front of queue and returns that element.
     * @return Integer
     */
    function pop() {
        array_shift($this->data);
    }

    /**
     * Get the front element.
     * @return Integer
     */
    function peek() {
        reset($this->data);
        return current($this->data);
    }

    /**
     * Returns whether the queue is empty.
     * @return Boolean
     */
    function empty() {
        return empty($this->data);
    }
}
