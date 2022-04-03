<?php


namespace App\Service;


use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Wire\AMQPTable;

class TtlQueueConfig
{
    const X_EXCHANGE = "X";
    const QUEUE_A = "QA";
    const QUEUE_B = "QB";
    const Y_DEAD_LETTER_EXCHANGE = "Y";
    const DEAD_LETTER_QUEUE = "QD";

    private $channel;

    public function __construct()
    {
        $this->channel = RabbitMQ::getChannel();
    }

    public function xExchange()
    {
        $this->channel->exchange_declare(self::X_EXCHANGE,AMQPExchangeType::DIRECT,false,false,false,false,false);
    }

    public function yExchange()
    {
        $this->channel->exchange_declare(self::Y_DEAD_LETTER_EXCHANGE,AMQPExchangeType::DIRECT,false,false,false,false,false);
    }

    public function queueA()
    {
        $table = new AMQPTable();
        //声明当前队列绑定的死信交换机
        $table->set("x-dead-letter-exchange",self::Y_DEAD_LETTER_EXCHANGE);
        //声明当前队列的死信路由 key
        $table->set("x-dead-letter-routing-key","YD");
        //声明队列的 TTL
        
    }

    public function queueB()
    {

    }

    public function queueB()
    {

    }
    public function queueB()
    {

    }
    public function queueB()
    {

    }
    public function queueB()
    {

    }
}
