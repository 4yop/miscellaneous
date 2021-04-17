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

    private $number = '';
    private $path = '';
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
        //echo base_path();

        $no = (int)$this->argument('no');
        if ($no < 1)
        {
            exit( "参数有误\n");
        }
        $this->path = base_path('leetcode/question/');
        $this->number = $no;
        $this->exec();
        return 0;
    }


    public function exec()
    {
        $files = scandir($this->path);
        foreach ($files as $file)
        {
            if (!is_file($this->path.$file))
            {
                continue;
            }
            $number =  (int)explode('.',pathinfo($file,PATHINFO_FILENAME))[0];
            if ($number == $this->number)
            {
//                echo $this->path.$file."\n";
                echo "\n--------leetCode question {$file}--------\n";
                include $this->path.$file;
                return;
            }
        }
        echo "\n leetcode 没这个编号的 {$this->number}\n";
    }
}
