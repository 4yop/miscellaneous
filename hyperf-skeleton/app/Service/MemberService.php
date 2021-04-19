<?php
namespace App\Service;


use App\Constants\MessageCode;
use App\Exception\BusinessException;
use App\Exception\NotFoundException;
use App\Model\Member;
use Hyperf\Di\Annotation\Inject;

class MemberService
{
    /**
     * @Inject()
     * @var Member
     */
    private $memberModel;

    /**
     * @Inject()
     * @var \Hyperf\Contract\SessionInterface
     */
    private $session;

    /**注册逻辑
     * @param string $username
     * @param string $password
     * @return Member
     */
    public function register(string $username,string $password):Member
    {
        $this->memberModel->username = $username;
        $this->memberModel->password = password_hash($password,PASSWORD_BCRYPT);
        $this->memberModel->save();
        return $this->memberModel;
    }

    /**登录逻辑
     * @param string $username
     * @param string $password
     * @return Member
     */
    public function login(string $username,string $password)
    {
        $member = $this->memberModel->where(["username"=>$username])->first();

        if ( !password_verify($password,$member->password) )
        {
            throw new BusinessException(MessageCode::ERROR,"密码有误");
        }
        $this->session->set('member_id',$member->id);
    }

    /**
     * @param string $username
     * @return Member
     */
    public function getByUsername(string $username):Member
    {
        $member = $this->memberModel->where(["username"=>$username])->first();
        if (!$member)
        {
            throw new NotFoundException(MessageCode::NOT_FOUND,"用户名不正确");
        }
        return $member;
    }

    public function getByUserId(int $id):Member
    {
        $member = $this->memberModel->where(["id"=>$id])->first();
        if (!$member)
        {
            throw new NotFoundException(MessageCode::NOT_FOUND,"用户找不到");
        }
        return $member;
    }

}