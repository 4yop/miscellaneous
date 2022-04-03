<?php

namespace App\Console\Commands\Eight;

use App\Service\RabbitMQ;
use Illuminate\Console\Command;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class Worker02 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer_dead_1';

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
            $this->getOutput()->writeln(date("Y-m-d H:i:s")." 收到：{$message->getBody()}");
        };



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
        $channel->basic_consume(self::DEAD_QUEUE,"",false,true,false,false,$callback);

        while ($channel->is_open())
        {
            $channel->wait();
        }

        return Command::SUCCESS;
    }
}
