<?php

/**注册者模式
 * 解决全局共享和交换对象。已经创建好的对象，挂在到某个全局可以使用的数组上，在需要使用的时候，直接从该数组上获取即可。将对象注册到全局的树上。任何地方直接去访问。
 * Class Register
 */
class Register
{
    protected static $obj = [];

    public static function set ($alias,$obj)
    {
        self::$obj[$alias] = $obj;
    }

    public static function get ($alias)
    {
        return self::$obj[$alias];
    }

    public static function remove ($alias)
    {
        unset(self::$obj[$alias]);
    }
}