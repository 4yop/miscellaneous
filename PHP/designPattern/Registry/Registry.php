<?php
namespace designPattern\Registry;

//注册树模式
//作用:注册器模式指将对象注册到全局树上，可直接设置获取注销对象
//解决全局共享和交换对象。已经创建好的对象，挂在到某个全局可以使用的数组上，在需要使用的时候，直接从该数组上获取即可。将对象注册到全局的树上。任何地方直接去访问。
abstract class Registry
{
    /**
     * @var
     */
    const LOGGER = 'logger';

    /**
     * 这里将在你的应用中引入全局状态，但是不可以被模拟测试。
     * 因此被视作一种反抗模式！使用依赖注入进行替换！
     *
     * @var array
     * 定义存储值数组。
     */
    private static $storeValues = [];

    /**
     * @var array
     * 定义合法键名数组。
     * 可在此定义用户名唯一性。
     */
    private static $allowedKeys  = [
        self::LOGGER,
    ];

    public static function set(string $key,$value):void
    {
        if (!in_array($key,self::$allowedKeys))
        {
            throw new \InvalidArgumentException("invalid key");
        }
        self::$storeValues[$key] = $value;
    }

    public static function get(string $key)
    {
        if (!in_array($key,self::$allowedKeys) || !isset(self::$storeValues[$key]))
        {
            throw new \InvalidArgumentException("invalid key");
        }
        return self::$storeValues[$key];
    }

    public static function unset(string $key)
    {
        if (!in_array($key,self::$allowedKeys) || !isset(self::$storeValues[$key]))
        {
            throw new \InvalidArgumentException("invalid key");
        }
        unset(self::$storeValues[$key]);
    }

}