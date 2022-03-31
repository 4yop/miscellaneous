<?php

namespace App\Service;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQ
{
    private static $connection;

    public static function getConnection()
    {
        if (!self::$connection instanceof AMQPStreamConnection)
        {
            self::$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'admin', 'admin');
        }
        return self::$connection;
    }

    public static function getChannel():AMQPChannel
    {
        return self::getConnection()->channel();
    }
}
