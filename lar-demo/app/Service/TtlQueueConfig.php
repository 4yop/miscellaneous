<?php


namespace App\Service;


use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class TtlQueueConfig
{
    const X_EXCHANGE = "X";
    const QUEUE_A = "QA";
    const QUEUE_B = "QB";
    const Y_DEAD_LETTER_EXCHANGE = "Y";
    const DEAD_LETTER_QUEUE = "QD";
    const QUEUE_C = "QC";

    private $channel;

    /**
     * @return \PhpAmqpLib\Channel\AMQPChannel
     */
    public function getChannel(): \PhpAmqpLib\Channel\AMQPChannel
    {
        return $this->channel;
    }

    public function __construct()
    {
        $this->channel = RabbitMQ::getChannel();
    }
    // 声明 xExchange
    public function xExchange()
    {
        $this->channel->exchange_declare(self::X_EXCHANGE,AMQPExchangeType::DIRECT,false,false,false,false,false);
    }
    // 声明 yExchange
    public function yExchange()
    {
        $this->channel->exchange_declare(self::Y_DEAD_LETTER_EXCHANGE,AMQPExchangeType::DIRECT,false,false,false,false,false);
    }
    //声明队列 A ttl 为 10s 并绑定到对应的死信交换机
    public function queueA()
    {
        $table = new AMQPTable();
        //声明当前队列绑定的死信交换机
        $table->set("x-dead-letter-exchange",self::Y_DEAD_LETTER_EXCHANGE);
        //声明当前队列的死信路由 key
        $table->set("x-dead-letter-routing-key","YD");
        //声明队列的 TTL
        $table->set("x-message-ttl",10000);

        $this->channel->queue_declare(self::QUEUE_A,false,false,false,false,false,$table);

    }
    // 声明队列 A 绑定 X 交换机
    public function queueaBindingX()
    {
        $this->channel->queue_bind(self::QUEUE_A,self::X_EXCHANGE,'XA');
    }
    //声明队列 B ttl 为 40s 并绑定到对应的死信交换机
    public function queueB()
    {
        $table = new AMQPTable();
        //声明当前队列绑定的死信交换机
        $table->set("x-dead-letter-exchange",self::Y_DEAD_LETTER_EXCHANGE);
        //声明当前队列的死信路由 key
        $table->set("x-dead-letter-routing-key","YD");
        //声明队列的 TTL
        $table->set("x-message-ttl",40000);

        $this->channel->queue_declare(self::QUEUE_B,false,false,false,false,false,$table);
    }
    //声明队列 B 绑定 X 交换机
    public function queuebBindingX()
    {
        $this->channel->queue_bind(self::QUEUE_B,self::X_EXCHANGE,'XB');
    }

    //声明队列 C 死信交换机
    public function queueC()
    {
        $table = new AMQPTable();
        //声明当前队列绑定的死信交换机
        $table->set("x-dead-letter-exchange",self::Y_DEAD_LETTER_EXCHANGE);
        //声明当前队列的死信路由 key
        $table->set("x-dead-letter-routing-key","XC");


        $this->channel->queue_declare(self::QUEUE_C,false,false,false,false,false,$table);
    }
    //声明队列 B 绑定 X 交换机
    public function queuecBindingX()
    {
        $this->channel->queue_bind(self::QUEUE_C,self::X_EXCHANGE,'XC');
    }


    //声明死信队列 QD
    public function queueD()
    {
        $this->channel->queue_declare(self::DEAD_LETTER_QUEUE,false,false,false,false,false);
    }
    //声明死信队列 QD 绑定关系
    public function deadLetterBindingQAD()
    {
        $this->channel->queue_bind(self::DEAD_LETTER_QUEUE,self::Y_DEAD_LETTER_EXCHANGE,'YD');
    }

    public function convertAndSend(string $exchange = '',string $routing_key = '',string $message = '',int $ttl = -1)
    {
        $properties = [];
        if ($ttl > 0)
        {
            $properties["expiration"] = $ttl*1000;
        }

        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg,$exchange,$routing_key);
    }

}
