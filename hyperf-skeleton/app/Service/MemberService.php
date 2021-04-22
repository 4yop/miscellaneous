<?php


namespace App\Service;
use Hyperf\Di\Annotation\Inject;
use App\Model\Member as MemberModel;
class MemberService
{
    /**
     * @Inject()
     * @var MemberModel
     */
    private $memberModel;

    public function register(string $username,string $password):MemberModel
    {
        $this->memberModel->username = $username;
        $this->memberModel->password = $password;
        $this->memberModel->save();
        return $this->memberModel;
    }

}