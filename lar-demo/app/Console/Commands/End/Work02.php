<?php

namespace App\Console\Commands\End;

use App\Service\ConfirmQueue;
use Illuminate\Console\Command;

class Work02 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'end_consumer_warning';

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
        $queue = new ConfirmQueue();

        $this->getOutput()->writeln("这个是warningConsumer消费");

        $queue->warningConsumer();

        return 0;
    }
}