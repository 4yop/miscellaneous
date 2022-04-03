<?php

namespace App\Console\Commands\Night;

use App\Service\RabbitMQ;
use App\Service\TtlQueueConfig;
use Illuminate\Console\Command;
use PhpAmqpLib\Message\AMQPMessage;

class Worker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer_delay';

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
        $channel->basic_consume(TtlQueueConfig::DEAD_LETTER_QUEUE,"",false,true,false,false,$callback);

        while ($channel->is_open())
        {
            $channel->wait();
        }

        return 0;
    }
}
