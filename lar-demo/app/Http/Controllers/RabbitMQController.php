<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQController extends Controller
{
    //
    public function test1()
    {

            //连接上 rabbit mq
            $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
            //开启一个通道
            $channel = $connection->channel();

            $channel->queue_declare('hello', false, false, false, false);
            $msg = new AMQPMessage('Hello World!');
            $channel->basic_publish($msg, '', 'hello');

            echo " [x] Sent 'Hello World!'\n";

            $channel->close();
            $connection->close();

    }
}
