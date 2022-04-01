<?php

namespace App\Console\Commands\Five;

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
    protected $signature = 'producer_exchange_direct {routing_key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '消费者,交换机模式';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private static string $exchange_name = "exchange_queue";

    protected static array $routing_keys = [
        'waring' => 'waring',
        'fatal'  => 'fatal',
        'debug'  => 'debug',
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $routing_key = $this->argument("routing_key");


        $channel = RabbitMQ::getChannel();


        /**声明一个交换机
         * @param string $exchange 名称
         * @param string $type 类型：direct、topic、headers 和fanout
         * @param bool $passive 是否被动
         * @param bool $durable 是否持久
         * @param bool $auto_delete 是否自动删除
         * @param bool $internal
         * @param bool $nowait 异步是否
         * @param AMQPTable|array $arguments
         * @param int|null $ticket
         */
        $channel->exchange_declare(self::$exchange_name,AMQPExchangeType::FANOUT,false,false,false);

        /**
         * 声明一个临时队列
         * 队列名称是随机的，消费者和该队列断开就自动删除
         */
        [$queue_name] = $channel->queue_declare("");
        //绑定交换机和队列
        $channel->queue_bind($queue_name, self::$exchange_name,'');

        $this->getOutput()->writeln("[*]等待接受消息");

        $callback = function (AMQPMessage $message) {
            $this->getOutput()->writeln("[x]收到消息:{$message->getBody()}");
        };

        $channel->basic_consume($queue_name,'',false,true,false,false,$callback);

        while ($channel->is_open())
        {
            $channel->wait();
        }

        return 0;
    }
}
