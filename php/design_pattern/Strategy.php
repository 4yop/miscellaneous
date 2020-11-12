<?php


/**
 * 策略模式 ，将一组特定的行为和算法封装成类，以适应特定的上下文环境
 *可实现 ：IOC，依赖倒置，控制反转
 *
 *
 */





interface Sms {
    /** 发短信
     * @return mixed
     */
    public function send();
}

class Ali implements Sms
{
    public function send ()
    {
        echo "发送阿里短信";
    }
}

class Jd implements Sms
{
    public function send ()
    {
        echo "发送京东短信";
    }
}

class Baidu implements Sms
{
    public function send ()
    {
        echo "发送百度短信";
    }
}

class Obj
{
    private $_smsObj = null;
    public function __construct (Sms $smsObj) {
        $this->_smsObj = $smsObj;
    }

    public function send ()
    {
        $this->_smsObj->send();
    }
}

$jd = new Jd();

$obj = new Obj($jd);

$obj->send();