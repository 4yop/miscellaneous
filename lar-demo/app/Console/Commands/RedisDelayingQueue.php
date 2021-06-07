<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RedisDelayingQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'redis 延时队列 demo';

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
        return 0;
    }




}
