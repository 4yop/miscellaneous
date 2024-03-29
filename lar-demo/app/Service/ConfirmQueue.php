<?php


namespace App\Service;


use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
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

    private $is_confirm_select = true;//是否开启

    public function __construct($is_confirm_select = true)
    {
        $this->channel = RabbitMQ::getChannel();

        $this->backExchange();

        $this->backupQueue();
        $this->backQueueBinding();

        $this->warningQueue();
        $this->warningQueueBinding();

        $this->confirmQueue();
        $this->confirmExchange();
        $this->confirmQueueBinding();

        if ($is_confirm_select)
        {
            $this->is_confirm_select = true;
            //$this->setMessageCallback();
            $this->channel->confirm_select();
        }

    }

    public function setMessageCallback($success_callback = null,$fail_callback = null)
    {
        if (!is_callable($success_callback))
        {
            $success_callback = function (AMQPMessage $message) {
                // code when message is confirmed
                echo "[*]".date("Y-m-d H:i:s")." 接收了:{$message->getBody()}\n";
            };
        }
        if (!is_callable($fail_callback))
        {
            $fail_callback = function (AMQPMessage $message) {
                // code when message is nack-ed
                echo "[*]".date("Y-m-d H:i:s")." 没接收:{$message->getBody()}\n";;
            };
        }

        //要写 wait_for_pending_acks();
        $this->channel->set_ack_handler($success_callback);

        $this->channel->set_nack_handler($fail_callback);
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
        $table = new AMQPTable();
        //备份交换机
        $table->set("alternate-exchange",self::BACKUP_EXCHANGE);
        $this->channel->exchange_declare(
            self::CONFIRM_EXCHANGE,
            AMQPExchangeType::DIRECT,
            false,
            true,
            false,
            false,
            false,
            $table
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
        $this->channel->queue_declare(self::CONFIRM_QUEUE,false,true,false,false,false);
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

    //声明 备份的交换机
    public function backExchange()
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
            self::BACKUP_EXCHANGE,
            AMQPExchangeType::FANOUT,
            false,
            true,
            false,
            false,
            false
        );
    }
    //声明备份的队列
    public function backupQueue()
    {
        $this->channel->queue_declare(self::BACKUP_QUEUE,false,true,false,false,false);
    }

    public function backQueueBinding()
    {
        $this->channel->queue_bind(self::BACKUP_QUEUE, self::BACKUP_EXCHANGE );
    }

    //声明警告的队列
    public function warningQueue()
    {
        $this->channel->queue_declare(self::WARNING_QUEUE,false,true,false,false,false);
    }

    public function warningQueueBinding()
    {
        $this->channel->queue_bind(self::WARNING_QUEUE, self::BACKUP_EXCHANGE );
    }


    public function sendMsg(string $msg_body = '')
    {
        $properties = [
            'delivery_mode'    => AMQPMessage::DELIVERY_MODE_PERSISTENT,
            "content_encoding" => "utf-8",
            "content_type"     => "application/json",
        ];
        $msg = new AMQPMessage($msg_body,$properties);
        $this->channel->basic_publish(
            $msg,
            self::CONFIRM_EXCHANGE,
            self::ROUTING_KEY,
            false,
        );
        if ($this->is_confirm_select)
        {
            // uses a 5 second timeout
            $this->channel->wait_for_pending_acks();
        }

    }

    private function commonConsumer($queue,$callback = null)
    {
        $callback = function (AMQPMessage $message) use ($callback) {

            //echo $message->getBody()."\n";
            if (is_callable($callback))
            {
                $callback($message);
            }
            if ($this->is_confirm_select)
            {
                $this->channel->basic_ack($message->getDeliveryTag(),false);
            }
        };
        /**
         * 消费
         * @param string $queue
         * @param string $consumer_tag
         * @param bool $no_local
         * @param bool $no_ack
         * @param bool $exclusive
         * @param bool $nowait
         * @param callable|null $callback
         * @param int|null $ticket
         * @param \PhpAmqpLib\Wire\AMQPTable|array $arguments
         *
         * @throws \PhpAmqpLib\Exception\AMQPTimeoutException if the specified operation timeout was exceeded
         * @throws \InvalidArgumentException
         * @return string
         */
        $this->channel->basic_consume($queue,"",false,false,false,false,$callback);

        while ($this->channel->is_open())
        {
            $this->channel->wait();
        }

    }

    public function confirmConsumer($callback = null)
    {
        $this->commonConsumer(self::CONFIRM_QUEUE,$callback);

    }

    public function backupConsumer($callback = null)
    {
        $this->commonConsumer(self::BACKUP_QUEUE,$callback);

    }

    public function warningConsumer($callback = null)
    {
        $this->commonConsumer(self::WARNING_QUEUE,$callback);
    }
}
