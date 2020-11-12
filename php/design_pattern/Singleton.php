<?php

/** 使得某个类只能创建一个，并供全局使用
 * Class Singleton
 */
class Singleton
{
    //该属性用来保存实例
    private static $_instance;
    //构造函数为private,防止创建对象
    private function __construct()
    {
        //实例
        self::$_instance = new Exception();
    }
    //防止对象被复制
    private function __clone(){}
    //创建一个用来实例化对象的方法
    public static function getInstance()
    {
        if (self::$_instance instanceof Singleton)
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}