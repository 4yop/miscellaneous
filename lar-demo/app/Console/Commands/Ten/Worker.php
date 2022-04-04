<?php

namespace App\Console\Commands\Ten;

use Illuminate\Console\Command;
use PhpAmqpLib\Message\AMQPMessage;

class Worker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer_delay_plugins';

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

        $queue->receiveDelayedQueue(function (AMQPMessage $message) {
            //dump($message->get_properties());
            $this->getOutput()->writeln(
                sprintf("时间为:%s 收到:%s",date("Y-m-d H:i:s"),$message->body)
            );
        });

        return 0;
    }
}
