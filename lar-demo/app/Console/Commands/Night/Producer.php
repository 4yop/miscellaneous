<?php

namespace App\Console\Commands\Night;

use App\Service\RabbitMQ;
use Illuminate\Console\Command;
use PhpAmqpLib\Exchange\AMQPExchangeType;

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
        $channel = RabbitMQ::getChannel();

        $channel->exchange_declare("X",AMQPExchangeType::DIRECT,false,false,false,false,false);

        $channel->queue_declare("QA",false,false,false,false,false);
        $channel->queue_declare("QB",false,false,false,false,false);

        $channel->exchange_declare("Y",AMQPExchangeType::DIRECT,false,false,false,false,false);

        $channel->queue_declare("QD",false,false,false,false,false);

        $channel->queue_bind("Y","QD","YD");

        return 0;
    }
}
