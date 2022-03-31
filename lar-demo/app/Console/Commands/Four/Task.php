<?php

namespace App\Console\Commands\Four;

use App\Service\RabbitMQ;
use Illuminate\Console\Command;
use PhpAmqpLib\Exception\AMQPChannelClosedException;
use PhpAmqpLib\Exception\AMQPConnectionBlockedException;
use PhpAmqpLib\Exception\AMQPConnectionClosedException;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class Task extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'producer_confirm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '必须队列和消息都持久化';

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

        /**
         *
         *
         * @param string $queue 队列名
         * @param bool $passive 是否被动 ,true的话，没队列不会自动创建
         * @param bool $durable 是否持久化
         * @param bool $exclusive 是否排他
         * @param bool $auto_delete 是否自动删除
         * @param bool $nowait 是否异步
         * @param array|AMQPTable $arguments
         * @param int|null $ticket
         * @return array|null
         */
        $channel->queue_declare(self::$queue_name,false,true,false,false,false);

        //要写 wait_for_pending_acks();
        $channel->set_ack_handler(function (AMQPMessage $message){
                // code when message is confirmed
            $this->getOutput()->writeln("set_ack_handler:".$message->getBody());
        });

        $channel->set_nack_handler(function (AMQPMessage $message){
                // code when message is nack-ed
            $this->getOutput()->writeln("set_nack_handler:".$message->getBody());
        });

        //单独确认,发一条确认一次；批量确认，发几条之后确认一次;异步确认,
        $channel->confirm_select();
        while ($input = fgets(STDIN))
        {
            $msg = new AMQPMessage($input,['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
            /**
             * Publishes a message
             *
             * @param AMQPMessage $msg 消息体
             * @param string $exchange 交换机
             * @param string $routing_key 路由key
             * @param bool $mandatory
             * @param bool $immediate
             * @param int|null $ticket
             */
            $channel->basic_publish($msg,"",self::$queue_name);



            // uses a 5 second timeout
            $channel->wait_for_pending_acks();

            $this->getOutput()->writeln("已发送消息");
        }



        return 0;
    }
}
