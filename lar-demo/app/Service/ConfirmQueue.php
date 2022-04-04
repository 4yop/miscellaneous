<?php


namespace App\Service;


use PhpAmqpLib\Wire\AMQPTable;

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

    //声明 确认的交换机
  public function confirmExchange()
    {
        /**
         * 声明交换机
         *
         * @param string $exchange
         * @param string $type
         * @param bool $passive
         * @param bool $durable
         * @param bool $auto_delete
         * @param bool $internal
         * @param bool $nowait
         * @param AMQPTable|array $arguments
         * @param int|null $ticket
         * @throws \PhpAmqpLib\Exception\AMQPTimeoutException if the specified operation timeout was exceeded
         * @return mixed|null
         */
        $this->channel->exchange_declare(self::CONFIRM_EXCHANGE);
    }

}
