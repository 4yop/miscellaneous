<?php


namespace App\Service;


use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Wire\AMQPTable;

class ConfirmQueue
{
    private $channel;

    const CONFIRM_EXCHANGE = "confirm.exchange";
    const BACKUP_EXCHANGE = "backup.exchange";
    const ROUTING_KEY = "key1";//CONFIRM_EXCHANGE的

    const CONFIRM_QUEUE = "confirm.queue";
    const WARNING_QUEUE = "warning.queue";
    const BACKUP_QUEUE = "backup.queue";

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
        $this->channel->exchange_declare(
            self::CONFIRM_EXCHANGE,
            AMQPExchangeType::DIRECT,
            false,
            true,
            false,
            false,
            false
        );
    }

    //声明确认的队列
    public function confirmQueue()
    {
        /**
         * 声明队列
         * @param string $queue
         * @param bool $passive
         * @param bool $durable
         * @param bool $exclusive
         * @param bool $auto_delete
         * @param bool $nowait
         * @param array|AMQPTable $arguments
         * @param int|null $ticket
         * @return array|null
         *@throws \PhpAmqpLib\Exception\AMQPTimeoutException if the specified operation timeout was exceeded
         */
        $this->channel->queue_declare(self::CONFIRM_QUEUE,false,true);
    }

    //绑定确定队列和确定交换机
    public function confirmQueueBinding()
    {
        /**
         * 绑定队列和交换机
         *
         * @param string $queue
         * @param string $exchange
         * @param string $routing_key
         * @param bool $nowait
         * @param \PhpAmqpLib\Wire\AMQPTable|array $arguments
         * @param int|null $ticket
         * @throws \PhpAmqpLib\Exception\AMQPTimeoutException if the specified operation timeout was exceeded
         * @return mixed|null
         */
        $this->channel->queue_bind(self::CONFIRM_QUEUE,self::CONFIRM_EXCHANGE,self::ROUTING_KEY);
    }

    

}
