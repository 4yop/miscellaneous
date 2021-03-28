<?php


namespace designPattern\Factory;


class FileLogger implements Logger
{
    public function __construct($path='')
    {
        echo "保存路径:{$path}";
    }

    public function log(string $message)
    {
        echo "用".__CLASS__."保存:";
        echo $message."\n";
    }
}