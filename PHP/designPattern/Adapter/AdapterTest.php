<?php


namespace designPattern\Adapter;


class AdapterTest
{
    public function __construct()
    {
        echo "\n适配器模式\n";

        $adapter = new UserAdapter();
        echo $adapter->getName()."\n";
        echo $adapter->getAge()."\n";

    }
}