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

    public static string $queue_name = "";
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
        }



        return 0;
    }
}
