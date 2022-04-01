<?php

namespace App\Console\Commands\Five;

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
    protected $signature = 'producer_exchange_direct';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生产者,交换机模式';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected static string $exchange_name = "log";

    protected static array $routing_keys = [
        'waring',
        'fatal',
        'debug',
    ];

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

        $channel->exchange_declare(
            self::$exchange_name ,
            AMQPExchangeType::DIRECT ,
            false ,
            false ,
            false );



        while ($input = fgets(STDIN))
        {
            [$body,$routing_key] = explode(" ",$input);
            $msg = new AMQPMessage($body);
            $channel->basic_publish($msg,self::$exchange_name,$routing_key);
            $this->getOutput()->writeln("已发送");
        }

        return 0;
    }


}
