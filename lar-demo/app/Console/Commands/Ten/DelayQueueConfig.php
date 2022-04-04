<?php


namespace App\Console\Commands\Ten;


use App\Service\RabbitMQ;

class DelayQueueConfig
{
    const DELAYED_QUEUE_NAME = "delayed.queue";

    const DELAYED_EXCHANGE_NAME = "delayed.exchange";

    const DELAYED_ROUTING_KEY = "delayed.routingkey";

    private $channel;

    public function __construct()
    {
        $this->channel = RabbitMQ::getChannel();
    }

}
