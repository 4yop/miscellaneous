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

        while ($input = fgets(STDIN))
        {
            [$body,$time] = explode(" ",$input);
            $queue->sendMsg($body,intval($time));
        }



        return 0;
    }
}
