<?php
namespace Demo;

class Redis
{
    private static $instance = null;
    public final static function getInstance():\Redis
    {
        if (self::$instance instanceof \Redis)
        {
            return self::$instance;
        }
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        self::$instance = $redis;
        return self::$instance;
    }

    private function __construct(){}

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

}