<?php


namespace App\Service;
use App\Exception\InvalidException;
use App\Exception\NotFoundException;
use Hyperf\Di\Annotation\Inject;
use App\Model\Member as MemberModel;
class MemberService
{
    /**
     * @Inject()
     * @var MemberModel
     */
    private $memberModel;

    /**注册
     * @param string $username
     * @param string $password
     * @return MemberModel
     */
    public function register(string $username,string $password):MemberModel
    {
        $member = $this->memberModel->where(['username'=>$username])->first();
        if ($member)
        {
            throw new InvalidException('用户名已存在');
        }
        $this->memberModel->username = $username;
        $this->memberModel->password = password_hash($password,PASSWORD_BCRYPT);
        $res = $this->memberModel->save();
        return $this->memberModel;
    }

    /**登录
     * @param string $username
     * @param string $password
     * @return \Hyperf\Database\Model\Builder|\Hyperf\Database\Model\Model|object
     */
    public function login(string $username,string $password)
    {
        $member = $this->getByUsername($username);
        if( !password_verify($password,$member->password) )
        {
            throw new InvalidException('密码有误');
        }
        return $member;
    }

    public function getByUsername(string $username)
    {
        $member = $this->memberModel->where(['username'=>$username])->first();
        if (!$member)
        {
            throw new NotFoundException("用户名不存在");
        }
        return $member;
    }

    /**
     * @param MemberModel $member
     * @return string
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getLoginToken (MemberModel $member):string
    {
        $token = md5(uniqid().time().uniqid());
        unset($member->password);
        if ( $old_token = cache()->get("user_id{$member->id}:token") )
        {
            cache()->delete("token:".$old_token);
        }

        cache()->set("user_id{$member->id}:token",$token,86400);
        cache()->set("token:".$token,$member,86400);
        return $token;
    }

    public function getByToken (string $token)
    {
        $member = cache()->get("token:".$token);
        if (!$member)
        {
            throw new NotFoundException("未登陆");
        }
        return $member;
    }

}