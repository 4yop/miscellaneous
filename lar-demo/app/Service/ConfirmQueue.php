<?php


namespace App\Service;


class ConfirmQueue
{
    private $channel;

    const CONFIRM_EXCHANGE = "confirm.exchange";
    const BACKUP_EXCHANGE = "backup.exchange";
    const ROUTING_KEY = "key1";//CONFIRM_EXCHANGE的

    const CONFIRM_QUEUE = "";
    const WARNING_QUEUE = "";
    const BACKUP_QUEUE = "";

    public function __construct()
    {
        $this->channel = RabbitMQ::getChannel();
    }
}
