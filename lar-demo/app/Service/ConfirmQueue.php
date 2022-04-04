<?php


namespace App\Service;


class ConfirmQueue
{
    private $channel;
    public function __construct()
    {
        $this->channel = RabbitMQ::getChannel();
    }
}
