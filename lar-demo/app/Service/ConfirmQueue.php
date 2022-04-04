<?php


namespace App\Service;


class ConfirmQueue
{
    private $channel;

    const CONFIRM_EXCHANGE = "confirm.exchange";
    const BACKUP_EXCHANGE = "backup.exchange";

    const CONFIRM_QUEUE = "";
    const WARING_QUEUE = "";

    public function __construct()
    {
        $this->channel = RabbitMQ::getChannel();
    }
}
