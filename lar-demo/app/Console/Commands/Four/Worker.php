<?php

namespace App\Console\Commands\Four;

use App\Service\RabbitMQ;
use Illuminate\Console\Command;

class Worker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer_confirm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public static string $queue_name = "confirm_queue";
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $channel = RabbitMQ::getChannel();
        $callback = function () {

        };
        /**
         * @param string $queue 队列名
         * @param string $consumer_tag 消费者标签
         * @param bool $no_local 这个功能属于AMQP的标准,但是rabbitMQ并没有做实现.
         * @param bool $no_ack 是否开启自动应答
         * @param bool $exclusive 排他
         * @param bool $nowait 异步
         * @param callable|null $callback 回调
         * @param int|null $ticket
         * @param \PhpAmqpLib\Wire\AMQPTable|array $arguments
         */
        $channel->basic_consume(self::$queue_name,"",false,false,false,false,);
        while($channel->is_open())
        {
            $channel->wait();
        }

        return 0;
    }
}
