<?php


namespace App\Service;


use App\Exception\NotFoundException;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Context;
use Hyperf\WebSocketServer\Context as WsContext;

class TokenService
{
    /**
     * @Inject()
     * @var \App\Service\MemberService
     */
    private $memberService;

    /**
     * 用户ID
     *
     * @var int
     */
    protected $memberId;

    /**
     * 用户信息
     *
     * @var \App\Model\Member
     */
    protected $memberInfo;

    /**
     * 是否登录
     *
     * @var boolean
     */
    protected $isLogin = false;



    public function getByToken (string $token)
    {
        $member = cache()->get("token:".$token);var_dump($member);
//        if (!$member)
//        {
//            throw new NotFoundException("未登陆");
//        }
        return $member;
    }

    public function getWsUserId ()
    {
        $member = \Hyperf\WebSocketServer\Context::get('member');
        if (!$member)
        {
            throw new NotFoundException("未登陆");
        }
        return $member;
    }



}