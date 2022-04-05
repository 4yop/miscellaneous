<?php

namespace App\Console\Commands\End;

use App\Service\ConfirmQueue;
use Illuminate\Console\Command;

class Task extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'producer_end';

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
        $queue = new ConfirmQueue(true);

        $queue->setMessageCallback();

        while ($input = fgets(STDIN))
        {
            $json = json_encode(['input'=>$input]);
            $queue->sendMsg($json);
        }



        return 0;
    }
}
