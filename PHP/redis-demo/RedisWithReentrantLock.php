<?php

require_once "helper.php";


class RedisWithReentrantLock
{
    private $thread;

    public function __construct ()
    {
        $this->thread = (new \Thread());
    }

    private function _lock(string $key):bool
    {
        return redis()->set('key', 'value', ['nx', 'ex' => 5]);
    }

    private function _unlock(string $key)
    {
        return redis()->del($key);
    }

    private function currentLockers()
    {
        $lockers = $this->thread->lock();
    }

    private function key_for($user_id)
    {
        return "account_{$user_id}";
    }


    public function lock($user_id)
    {
        $key = $this->key_for($user_id);

    }

    public function unlock(){}
}







