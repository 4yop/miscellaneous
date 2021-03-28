<?php


namespace designPattern\Adapter;

//适配器模式
//场景:原对象不能修改，或不希望在原对象改
//作用:将某个对象的接口适配到另一个对象的接口，使其兼容
class UserAdapter extends User
{
    public function getAge():int
    {
        return (int)date('Y') - 1995;
    }

    public function getHeight():string
    {
        return "1.83m";
    }

}