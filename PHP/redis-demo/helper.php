<?php
    require_once "redis.php";

    function redis()
    {
        return \Demo\Redis::getInstance();
    }