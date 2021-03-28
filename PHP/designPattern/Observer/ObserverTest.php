<?php


namespace designPattern\Observer;


class ObserverTest
{
    public function __construct()
    {
        echo "观察者模式\n";
        $observer = new UserObserver();
        echo "长度:".count($observer->getChangedUsers())."\n";
        $user = new User();
        $user->attach($observer);
        $user->changeEmail('113155@qq.com');
        echo "长度:".count($observer->getChangedUsers())."\n";
    }
}