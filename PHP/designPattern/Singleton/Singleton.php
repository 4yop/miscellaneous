<?php

//单例模式:特定对象只能被创建一次
//场景:数据库实例
//作用:在应用程序调用的时候，只能获得一个实例对象。单少类的实例化
namespace designPattern\Singleton;


final class Singleton
{
    /**
     * @var
     */
    private static $instace;

    /**
     * 通过懒加载获得实例（在第一次使用的时候创建）
     */
    public static function getInstace():Singleton
    {
        if (null === static::$instace)
        {
            self::$instace == new static();
        }
        return self::$instace;
    }

    /**
     * 不允许从外部调用以防止创建多个实例
     * 要使用单例，必须通过 Singleton::getInstance() 方法获取实例
     */
    private function __construct()
    {

    }

    /**
     * 防止实例被克隆（这会创建实例的副本）
     */
    private function __clone()
    {

    }

    /**
     * 防止实例被克隆（这会创建实例的副本）
     */
    private function __wakeup()
    {

    }
}