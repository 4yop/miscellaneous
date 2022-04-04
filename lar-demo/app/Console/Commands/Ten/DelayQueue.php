<?php


namespace App\Console\Commands\Ten;


use App\Service\RabbitMQ;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class DelayQueue
{
    const DELAYED_QUEUE_NAME = "delayed.queue";

    const DELAYED_EXCHANGE_NAME = "delayed.exchange";

    const DELAYED_ROUTING_KEY = "delayed.routingkey";

    private $channel;

    public function __construct()
    {
        $this->channel = RabbitMQ::getChannel();

        $this->delayedExchange();
        $this->delayedQueue();
        $this->bindingDelayedQueue();
    }

    /**
     * @return \PhpAmqpLib\Channel\AMQPChannel
     */
    public function getChannel(): \PhpAmqpLib\Channel\AMQPChannel
    {
        return $this->channel;
    }

    //自定义交换机 我们在这里定义的是一个延迟交换机
    public function delayedExchange()
    {
        $table = new AMQPTable();
        $table->set("x-delayed-type",AMQPExchangeType::DIRECT);
        $this->channel->exchange_declare(
            self::DELAYED_EXCHANGE_NAME,
            "x-delayed-message",
            false,
            true,
            false,
            false,
            false,
            $table);
    }

    public function delayedQueue()
    {
        $this->channel->queue_declare(self::DELAYED_QUEUE_NAME);
    }

    public function bindingDelayedQueue()
    {
        $this->channel->queue_bind(
            self::DELAYED_QUEUE_NAME,
            self::DELAYED_EXCHANGE_NAME,
            self::DELAYED_ROUTING_KEY);
    }

    public function sendMsg($body = '',$time = 0)
    {


        $msg = new AMQPMessage($body);
        $msg->set("application_headers",new AMQPTable(['x-delay'=>intval($time)*1000]));

        //dump($msg->get_properties());
        $this->channel->basic_publish(
            $msg,
            self::DELAYED_EXCHANGE_NAME,
            self::DELAYED_ROUTING_KEY);
    }

    public function receiveDelayedQueue($callback = null)
    {
        $this->channel->basic_consume(
            self::DELAYED_QUEUE_NAME,
            "",
            false,
            true,
            false,
            false,
            $callback
        );
        while ($this->channel->is_open())
        {
            $this->channel->wait();
        }
    }

}
