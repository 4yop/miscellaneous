<?php


namespace App\Http\Controllers;

use malkusch\lock\mutex\Mutex;

class LockController extends Controller
{
    //互斥锁
    public function mutex()
    {
        $mutex = new \malkusch\lock\mutex\PHPRedisMutex([],'abc',1);
        $bankAccount = 1;$amount = 1;
        $newBalance = $mutex->synchronized(function () use (
            $bankAccount,
            $amount
        ): int {
            $balance = $bankAccount->getBalance();
            $balance -= $amount;
            if ($balance < 0) {
                throw new \DomainException('You have no credit.');
            }
            $bankAccount->setBalance($balance);

            return $balance;
        });
    }
}
