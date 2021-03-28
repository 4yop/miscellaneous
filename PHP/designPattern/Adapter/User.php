<?php
namespace designPattern\Adapter;

class User
{
    public function getName():string
    {
        return "小明";
    }

    public function getSex():string
    {
        return "男";
    }
}