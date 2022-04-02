<?php

namespace App\Console\Commands\Eight;

use App\Service\RabbitMQ;
use Illuminate\Console\Command;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class Worker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer_deal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '死信,消费者';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public const NORMAL_EXCHANGE = "normal_exchange";
    public const DEAD_EXCHANGE = "dead_exchange";
    public const NORMAL_QUEUE = "normal_queue";
    public const DEAD_QUEUE = "dead_queue";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        //消息被拒，ttl过期，到达最大长度，成为死信
        $channel = RabbitMQ::getChannel();
        $callback = function (AMQPMessage $message) {
            $this->getOutput()->writeln("收到：{$message->getBody()}");
        };
        /**
         * 声明交换机
         * @param string $exchange 交换机名
         * @param string $type 类型 AMQPExchangeType::xx
         * @param bool $passive 是否被动
         * @param bool $durable 持久化
         * @param bool $auto_delete 自动删除
         * @param bool $internal
         * @param bool $nowait 异步
         * @param AMQPTable|array $arguments
         * @param int|null $ticket
         */
        $channel->exchange_declare(self::NORMAL_EXCHANGE,AMQPExchangeType::DIRECT,false,false,false,false,false);
        $channel->exchange_declare(self::DEAD_EXCHANGE,AMQPExchangeType::DIRECT,false,false,false,false,false);

        /**
         * 声明队列
         * @param string $queue 队列名
         * @param bool $passive  是否被动
         * @param bool $durable 持久化
         * @param bool $exclusive 排他
         * @param bool $auto_delete 自动删除
         * @param bool $nowait 异步
         * @param array|AMQPTable $arguments
         * @param int|null $ticket
         * @return array|null
         *@throws \PhpAmqpLib\Exception\AMQPTimeoutException if the specified operation timeout was exceeded
         */

        $arguments = [
            'x-dead-letter-exchange'    => self::DEAD_EXCHANGE,//死信交换机
            'x-dead-letter-routing-key' => 'lisi',//死信路由key
            //'x-message-ttl'             => 10000,//过期时间 1000毫秒=1秒
        ];
        $channel->queue_declare(self::NORMAL_QUEUE,false,false,false,false,false,$arguments);
        $channel->queue_declare(self::DEAD_QUEUE,false,false,false,false,false,[]);


        /**绑定普通和死信的关系
         * @param string $queue 队列名
         * @param string $exchange 交换机名
         * @param string $routing_key 路由key
         * @param bool $nowait 异步
         */
        $channel->queue_bind(self::NORMAL_QUEUE,self::NORMAL_EXCHANGE,"zhangsan");
        $channel->queue_bind(self::DEAD_QUEUE,self::DEAD_EXCHANGE,"lisi");
        $this->getOutput()->writeln("[*]等待接收消息");
        /**
         * @param string $queue 队列名
         * @param string $consumer_tag 标签
         * @param bool $no_local
         * @param bool $no_ack 自动ack
         * @param bool $exclusive 排他
         * @param bool $nowait 异步
         * @param callable|null $callback 回调
         * @param int|null $ticket
         */
        $channel->basic_consume();

        while ($channel->is_open())
        {
            $channel->wait();
        }

        return Command::SUCCESS;
    }
}
