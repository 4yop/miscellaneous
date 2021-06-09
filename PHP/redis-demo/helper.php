<?php
    require_once "redis.php";

error_reporting(E_ALL);
ini_set("display_errors", "On");
    function redis()
    {
        return \Demo\Redis::getInstance();
    }