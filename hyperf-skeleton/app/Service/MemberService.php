<?php
namespace App\Service;


use App\Model\Member;
use Hyperf\Di\Annotation\Inject;

class MemberService
{
    /**
     * @Inject()
     * @var Member
     */
    protected $memberModel;

    public function register(string $username,string $password):Member
    {
        $this->memberModel->username = $username;
        $this->memberModel->password = password_hash($password,PASSWORD_BCRYPT);
        $this->memberModel->save();
        return $this->memberModel;
    }
}