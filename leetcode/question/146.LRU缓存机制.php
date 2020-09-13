<?php
class LRUCache {
    /**
     * @param Integer $capacity
     */
    public $arr = [];
    public $cap = 0;
    public $count = 0;
    function __construct($capacity) {
        $this->cap = $capacity;
    }

    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        if (array_key_exists($key,$this->arr)) {
            $value = $this->arr[$key];
            unset($this->arr[$key]);
            $this->arr[$key] = $value;
            return $value;
        }
        return -1;
    }

    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {

        if ($this->get($key) != -1) {
            $this->arr[$key] = $value;
            return;
        }else if ($this->cap <= $this->count) {
            reset($this->arr);
            $k = key($this->arr);
            unset($this->arr[$k]);
        }else{
            $this->count++;
        }
        $this->arr[$key] = $value;
    }
}

/**
 * Your LRUCache object will be instantiated and called as such:
 * $obj = LRUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */

$cache = new LRUCache( 2 /* 缓存容量 */ );

$res = [];
$res[] = $cache->put(1, 1);
$res[] = $cache->put(2, 2);
$res[] = $cache->get(1);       // 返回  1
$res[] = $cache->put(3, 3);    // 该操作会使得关键字 2 作废
$res[] = $cache->get(2);       // 返回 -1 (未找到)
$res[] = $cache->put(4, 4);    // 该操作会使得关键字 1 作废
$res[] = $cache->get(1);       // 返回 -1 (未找到)
$res[] = $cache->get(3);       // 返回  3
$res[] = $cache->get(4);       // 返回  4



print_r($res);
