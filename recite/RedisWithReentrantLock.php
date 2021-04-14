<?php


class RedisWithReentrantLock
{
    private $lockers = null;

    private $redis = null;
    public function __construct()
    {
        $this->lockers = new \Thread();
        $this->redis = new \Redis();
        $this->redis->connect('127.0.0.1','6379');
    }

    private function _lock(string $key):bool
    {
        return $this->redis->set($key,"",array('nx', 'ex' => 5));
    }

    private function _unlock(string $key):void {
        $this->redis->del($key);
    }

    private function currentLockers() {



    }


}