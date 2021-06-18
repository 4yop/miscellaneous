<?php

namespace App\Console\Commands;

use http\Exception\InvalidArgumentException;
use Illuminate\Console\Command;
use leetcode\common\Base;
use Symfony\Component\Finder\Finder;



class TestLeetcodeQuestion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leetcode';

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

        fwrite(STDOUT, "请输入需要执行的leetcode题目编号,0退出:\n");
        $no = trim(fgets(STDIN));
        if ($no == 0)
        {
            exit;
        }
        if ($no < 1) {
            echo "参数有误\n";return;
        }

        $this->path = base_path('leetcode/question/');
        $this->number = $no;
        $this->exec();


    }


    public function exec()
    {
        $finder = new Finder();
        $iterator = $finder->files()
                            ->name("{$this->number}.*")
                            ->depth(0)
                            ->in($this->path);

        if ($iterator->count() < 1)
        {
            echo "\n leetcode 没这个编号的 {$this->number}\n";
        }

        foreach ($iterator as $file)
        {
            include $file->getRealpath();
            return;
        }



//        $files = scandir($this->path);
//        foreach ($files as $file)
//        {
//            if (!is_file($this->path.$file))
//            {
//                continue;
//            }
//            $number =  (int)explode('.',pathinfo($file,PATHINFO_FILENAME))[0];
//            if ($number == $this->number)
//            {
////                echo $this->path.$file."\n";
//                echo "\n--------leetCode question {$file}--------\n";
//                include $this->path.$file;
//                return;
//            }
//        }
//        echo "\n leetcode 没这个编号的 {$this->number}\n";
    }
}
