<?php


namespace designPattern\Observer;


class UserObserver implements  \SplObserver
{
    /**
     * @var array
     */
    private $changedUsers = [];

    /**
     * 它通常使用  SplSubject::notify()  通知主体
     *
     * @param \SplSubject $subject
     */
    public function update(\SplSubject $subject)
    {
        $this->changedUsers[] = clone $subject;
    }

    /**
     * @return User[]
     */
    public function getChangedUsers(): array
    {
        return $this->changedUsers;
    }
}