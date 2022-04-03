<?php

namespace App\Console\Commands\Eight;

use App\Service\RabbitMQ;
use Illuminate\Console\Command;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class Task extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'producer_dead';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '死信,生产者';

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
        $channel = RabbitMQ::getChannel();
        /**声明一个交换机
         * @param string $exchange 名称
         * @param string $type 类型：direct(对于routeKey的收)、topic、headers 和fanout(一人发,全收)
         * @param bool $passive 是否被动
         * @param bool $durable 是否持久
         * @param bool $auto_delete 是否自动删除
         * @param bool $internal
         * @param bool $nowait 异步是否
         * @param AMQPTable|array $arguments
         * @param int|null $ticket
         */

        $channel->exchange_declare( self::NORMAL_EXCHANGE , AMQPExchangeType::DIRECT , false , false , false );



        while ($input = fgets(STDIN))
        {
            $properties = [
                "expiration"=>10000
            ];
            $msg = new AMQPMessage($input,$properties);
            $channel->basic_publish($msg,self::NORMAL_EXCHANGE,"zhangsan");
            $this->getOutput()->writeln("已发送".date("Y-m-d H:i:s")." 预计:".date("Y-m-d H:i:s",time()+10)."收到");
        }

        return 0;
    }


}
