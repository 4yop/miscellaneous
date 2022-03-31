<?php

namespace App\Console\Commands\Four;

use App\Service\RabbitMQ;
use Illuminate\Console\Command;

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

        return 0;
    }
}
