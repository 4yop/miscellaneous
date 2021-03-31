<?php
namespace leetcode;

class Question
{
    private $number;
    private $path = __DIR__.'/question/';
    public function __construct(int $number)
    {
        $this->number = $number;
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
                echo $this->path.$file."\n";
                echo "\n leetCode question \n";
                include $this->path.$file;return;
            }
        }
        echo "\n leetcode 没这个编号的\n";
    }


}