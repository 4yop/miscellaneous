<?php


namespace designPattern\Factory;


class StuoutLogger implements Logger
{
    public function log(string $message)
    {
        echo "用".__CLASS__."保存:";
        echo $message."\n";
    }
}