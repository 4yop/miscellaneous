<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Consumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public static string $queue_name = "hello";
    protected AMQPStreamConnection $connection;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //创建连接
        $this->connection = new AMQPStreamConnection('127.0.0.1', 5672, 'admin', 'admin');

        $callback = function ($msg)
        {
            echo  ' [x] ' , $msg->body, "\n" ;
            //dump($msg);
        };

        //获取信道
        $channel = $this->connection->channel();

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
        $this->getOutput()->writeln("消息:{$consumer_tag}");


        while ($channel->is_open()) {
            $channel->wait();
        }


        return Command::SUCCESS;
    }
}
