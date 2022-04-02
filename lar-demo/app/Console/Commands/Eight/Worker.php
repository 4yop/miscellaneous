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

        $channel->basic_consume();


        while ($channel->is_open())
        {
            $channel->wait();
        }
        return Command::SUCCESS;
    }
}
