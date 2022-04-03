<?php

namespace App\Console\Commands\Night;

use App\Service\RabbitMQ;
use App\Service\TtlQueueConfig;
use Illuminate\Console\Command;

class Worker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer_delay';

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

        $this->getOutput()->writeln();

        return 0;
    }
}
