<?php

namespace App\Console\Commands;

use http\Exception\InvalidArgumentException;
use Illuminate\Console\Command;

class TestLeetcodeQuestion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leetcode {no}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试运行leetcode题目';

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
        $no = (int)$this->argument('no');
        if ($no < 1)
        {
            exit( "参数有误\n");
        }
        return 0;
    }
}
