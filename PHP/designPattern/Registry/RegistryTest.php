<?php


namespace designPattern\Registry;


class RegistryTest
{
    public function __construct()
    {
        echo "\n注册模式\n";
        try{
            $key = Registry::LOGGER;
            Registry::set($key,'123312');
            $value = Registry::get($key);
            echo "$value\n";

            Registry::set('qq','qq');
            $value = Registry::get($key);
        echo "$value\n";
        }catch (\Throwable $e){
            echo "{$e->getMessage()}\n";
        }
    }
}