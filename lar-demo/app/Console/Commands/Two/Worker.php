<?php

namespace App\Console\Commands\Two;

use App\Service\RabbitMQ;
use Illuminate\Console\Command;

class Worker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer-worker';

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
    public static string $queue_name = "hello";
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $callback = function ($msg)
        {
            echo  ' [x] ' , $msg->body, "\n" ;
            //dump($msg);
        };
        $channel = RabbitMQ::getChannel();
        /**
         * @param string $queue 消息要取得消息的队列名
         * @param string $consumer_tag 消费者标签
         * @param bool $no_local 这个功能属于AMQP的标准,但是rabbitMQ并没有做实现.
         * @param bool $no_ack 是否自动应答,收到消息后,是否不需要回复确认即被认为被消费
         * @param bool $exclusive 排他消费者,即这个队列只能由一个消费者消费.适用于任务不允许进行并发处理的情况下.比如系统对接
         * @param bool $nowait 不返回执行结果,但是如果排他开启的话,则必须需要等待结果的,如果两个一起开就会报错
         * @param callable|null $callback 回调函数
         * @param int|null $ticket
         * @param \PhpAmqpLib\Wire\AMQPTable|array $arguments
         */
        $consumer_tag = $channel->basic_consume(self::$queue_name,'',false,true,false,false,$callback);

        while ($channel->is_open()) {
            $channel->wait();
        }

        return Command::SUCCESS;
    }
}
