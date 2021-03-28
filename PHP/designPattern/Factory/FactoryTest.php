<?php


namespace designPattern\Factory;


class FactoryTest
{
    public function __construct()
    {
        echo "\n工厂模式TEST\n";
        $factory = new LoggerFactory();
        $fileLogger = $factory->load('StuoutLogger');
        $fileLogger->log("aaa");

        $fileLogger = $factory->load('FileLogger');
        $fileLogger->log("aaa","/d/e");
    }
}