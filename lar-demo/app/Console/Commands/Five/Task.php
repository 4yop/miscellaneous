<?php

namespace App\Console\Commands\Five;

use Illuminate\Console\Command;

class Task extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'producer_exchange';

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

    public static string $queue_name = "exchange_queue";
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
