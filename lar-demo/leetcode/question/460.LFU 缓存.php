<?php
class LFUCache {
    /**
     * @param Integer $capacity
     */
    protected $data;
    function __construct($capacity) {
        $this->data = new SplFixedArray($capacity);
    }

    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {

    }

    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {

    }
}

/**
 * Your LFUCache object will be instantiated and called as such:
 * $obj = LFUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */
