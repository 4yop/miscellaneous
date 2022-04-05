<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class Producer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'producer';

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
        //创建连接
        $this->connection = new AMQPStreamConnection('127.0.0.1', 5672, 'admin', 'admin');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //获取信道
        $channel = $this->connection->channel();

        $table = new AMQPTable();
        $table->set("x-max-priority",5);

        //创建队列
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
        $channel->queue_declare(self::$queue_name,false,false,false,false,false,$table);
        for($i = 0;$i < 10;$i++) {
            $message = "{$i} hello world";
            $pro = ['priority'=>$i];
            $msg = new AMQPMessage($message,$pro);
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
            $channel->basic_publish($msg, "", self::$queue_name);
            $this->getOutput()->writeln("消息已发送");
        }
        return Command::SUCCESS;
    }
}
