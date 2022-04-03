<?php

namespace App\Console\Commands\Night;

use App\Service\RabbitMQ;
use App\Service\TtlQueueConfig;
use Illuminate\Console\Command;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;

class Producer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'producer_delay';

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
        $config = new TtlQueueConfig();
        $config->xExchange();
        $config->yExchange();

        $config->queueD();
        $config->deadLetterBindingQAD();

        $config->queueA();
        $config->queueaBindingX();

        $config->queueB();
        $config->queuebBindingX();

        $a = new AMQPMessage();

        while ($message = fgets(STDIN))
        {
            $this->getOutput()->writeln("当前时间为：".date("Y-m-d H:i:s")."发送一条信息给两个ttl队列:$message");

            $config->convertAndSend("X","XA","消息来自 ttl 为 10S 的队列: ".$message);
            $config->convertAndSend("X","XB","消息来自 ttl 为 40S 的队列: ".$message);

            $config->convertAndSend("X","XC","消息来自 ttl 为 11S 的队列: ".$message,11);
        }

        return 0;
    }
}
