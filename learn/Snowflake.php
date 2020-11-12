<?php
//defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 *  雪花全局唯一 ID 生成类
 *  修改了机器id和序列号自动获取 理论上毫秒可生成 1024*4096个唯一id
 *  组成: <毫秒级时间戳+机器id+序列号>
 *  41bit的时间戳 可以支持该算法使用到2082年，
 *  10bit的机器id 可以支持1023台机器，
 *  12bit序列号   可以支持1毫秒产生4095个自增序列id
 *
 */
class Snowflake
{
    const EPOCH    = 1479533469598; //开始时间,固定一个小于当前时间的毫秒数
    const max12bit = 4095;
    const max41bit = 1099511627775;

    static $LAST_TIME_MID = 0; // 上次的机器id
    static $SEQUENCE_NUM  = 0; //

    public static function createOnlyId()
    {
        // 时间戳 42字节
        $time = floor(microtime(true) * 1000);
        // 当前时间 与 开始时间 差值
        $time -= self::EPOCH;
        // 二进制的 毫秒级时间戳
        $base = decbin(self::max41bit + $time);

        // 获取序列数
        self::get_num();

        // 获取机器id
        self::get_mid();

        // 机器id  10 字节
        $machineid = str_pad(decbin(self::$LAST_TIME_MID), 10, "0", STR_PAD_LEFT);

        // 序列数 12字节
        $random = str_pad(decbin(self::$SEQUENCE_NUM), 12, "0", STR_PAD_LEFT);
        // 拼接
        $base = $base . $machineid . $random;

        if (strpos(PHP_OS, "WIN") !== false)
        {
            //win下会科学计数 格式化
            return number_format(bindec($base), 0, '', ''); //输出16位id 4369796497932289
        }
        return bindec($base); // 输出19位id 4940315248386113537
    }

    //机器id 10字节 1-1023
    public static function get_mid()
    {
        if (self::$SEQUENCE_NUM >= 4095)
        {
            self::$LAST_TIME_MID++;
            if (self::$LAST_TIME_MID > 1023)
            {
                self::$LAST_TIME_MID = 0;
            }
        }
    }
    //12字节 1-4095
    public static function get_num()
    {
        self::$SEQUENCE_NUM++;
        if (self::$SEQUENCE_NUM > 4095)
        {
            self::$SEQUENCE_NUM = 0;
        }
    }
}


//echo Snowflake::createOnlyId();