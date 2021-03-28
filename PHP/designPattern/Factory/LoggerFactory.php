<?php


namespace designPattern\Factory;

//工厂模式
//作用:建立统一的类实例化，统一调用，统一控制

class LoggerFactory
{
    public function load($class,$parame=''):Logger
    {
        $className = 'designPattern\\Factory\\'.$class;
        return new $className($parame);
    }
}