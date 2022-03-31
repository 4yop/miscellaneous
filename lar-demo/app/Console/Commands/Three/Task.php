<?php

namespace App\Console\Commands\Three;

use App\Service\RabbitMQ;
use Illuminate\Console\Command;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class Task extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'producer_ack';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '消息在应答时不丢失,返回队列重新消费';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    public static string $task_queue_name = "ack_queue";
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $channel = RabbitMQ::getChannel();
        //创建队列,必须队列和消息都持久化
        //$channel->confirm_select();

        /**
         * Declares queue, creates if needed
         *
         * @param string $queue 队列名称
         * @param bool $passive 被动模式，为true时，如果$queue不存在，则返回错误(不创建队列，只是检测队列是否存在)，为false时，如果$queue不存在，则创建此队列，然后返回OK
         * @param bool $durable 是否消息持久化(存磁盘)，否则(存内存)重启没了
         * @param bool $exclusive 排他性,该队列是否只提供一个消费者消费,是否进行消息共享，true可多个消费者，false只能一个消费者
         * @param bool $auto_delete 是否自动删除 最后一个消费者端开连接以后 该队列是否自动删除 true 自动删除
         * @param bool $nowait 异步执行，为true时，不等待队列创建结果，立即完成函数调用
         * @param array|AMQPTable $arguments 设定消息队列的额外参数，如存活时间等
         * @param int|null $ticket 传0或null即可
         */
        $channel->queue_declare(self::$task_queue_name,false,true,false,false,false);

        while ($input = trim(fgets(STDIN)))
        {
            $message = $input;
            //设置消息持久化
            $msg = new AMQPMessage($message,['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
            /**
             * 发送消息
             *
             * @param AMQPMessage $msg 发送的消息体
             * @param string $exchange 发送到哪个交换机
             * @param string $routing_key 路由的key
             * @param bool $mandatory
             * @param bool $immediate
             * @param int|null $ticket
             */
            $channel->basic_publish($msg, "", self::$task_queue_name);
            $this->getOutput()->writeln("消息已发送");
        }

        return Command::SUCCESS;
    }
}
