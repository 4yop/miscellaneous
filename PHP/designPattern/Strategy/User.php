<?php

namespace designPattern\Strategy;

//策略模式
//作用:构建自身不必要的逻辑，利用其它对象的算法
class User
{
    /**
     * @var array
     */
    private $userInfo = [];

    public function __construct(string $name = "小明",$age = "100")
    {
        $this->userInfo['name'] = $name;
        $this->userInfo['age'] = $age;
    }

    public function getUserInfo (ConvertInterface $type)
    {
        return $type->serialize($this->userInfo);
    }

}