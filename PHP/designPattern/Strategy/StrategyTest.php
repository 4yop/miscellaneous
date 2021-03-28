<?php


namespace designPattern\Strategy;


class StrategyTest
{
    public function __construct()
    {
        echo "\n策略模式\n";
        $user = new User("小红",50);

        $data = $user->getUserInfo(new Xml());
        echo $data."\n";

        $data = $user->getUserInfo(new Json());
        echo $data."\n";
    }
}