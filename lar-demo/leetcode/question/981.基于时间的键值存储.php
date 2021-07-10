<?php

class ListNode
{
    public $val = 0;
    public $timestamp = 0;
    public $next = null;
    public function __construct($val,$timestamp)
    {
        $this->val = $val;
        $this->timestamp = $timestamp;
    }
}



class TimeMap {
    /**
     * Initialize your data structure here.
     */
    public $data = [];
    function __construct() {

    }

    /**
     * @param String $key
     * @param String $value
     * @param Integer $timestamp
     * @return NULL
     */
    function set($key, $value, $timestamp) {

        if (!isset($this->data[$key]))
        {
            $this->data[$key] = new ListNode($value,$timestamp);
        }else
        {
            $aa = new ListNode(PHP_INT_MAX,PHP_INT_MAX);
            $aa->next = $this->data[$key];
            $node = $aa;
            $flag = true;
            while ($node->next != null)
            {
                if ($timestamp >= $node->next->timestamp)
                {
                    $next = $node->next;
                    $a = new ListNode($value, $timestamp);
                    $a->next = $next;
                    $node->next = $a;
                    $flag = false;
                }
                $node = $node->next;
            }
            if ($flag)
            {
                $next = $node->next;
                $a = new ListNode($value, $timestamp);
                $a->next = $next;
                $node->next = $a;
            }
            $this->data[$key] = $aa->next;
        }

    }

    /**
     * @param String $key
     * @param Integer $timestamp
     * @return String
     */
    function get($key, $timestamp) {
        foreach ($this->data[$key] as $time=>$val)
        {
            if ($time >= $timestamp)
            {
                return $val;
            }
        }
        return "";
    }
}

$t = new TimeMap();

$t->set('aaa',9,9);
var_dump($t->data);
$t->set('aaa',1,1);
var_dump($t->data);
$t->set('aaa',2,2);
var_dump($t->data);
