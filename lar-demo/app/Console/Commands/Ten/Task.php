<?php

namespace App\Console\Commands\Ten;

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
    protected $signature = 'producer_delay_plugins';

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
        $queue = new DelayQueue();

        $channel = $queue->getChannel();
        //publisherConfirmType
        while ($input = fgets(STDIN))
        {
            [$body,$time] = explode(" ",$input);
            $time = intval($time);
            $queue->sendMsg($body,$time);
            $this->getOutput()->writeln(
                sprintf("%s 已发消息:%s 预计%s收到",date("Y-m-d H:i:s"),$body,date("Y-m-d H:i:s",time()+$time))
            );
        }



        return 0;
    }
}
