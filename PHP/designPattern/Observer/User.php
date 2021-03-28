<?php
namespace designPattern\Observer;

//观察者模式:
//场景:订单创建完成后，会做各种动作，比如发送 EMAIL，或者改变订单状态等等。
//作用:当对象的状态发生变化，所有依赖它的对象都得到通知并自动更新,降低耦合

/**
 * User 实现观察者模式 (称为主体)，它维护一个观察者列表，
 * 当对象发生变化时通知  User。
 */
class User implements \SplSubject{

    /**
     * @var string
     */
    private $email;

    /**
     * @var \SplObjectStorage
     */
    private $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function attach (\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }
    public function detach (\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function changeEmail(string $email)
    {
        $this->email = $email;
        $this->notify();
    }

    public function notify ()
    {
        /** @var \SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}