<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Exception\NoLoginException;
use App\Service\MemberService;
use App\Request\LoginRequest;
use App\Request\RegisterRequest;
use App\Service\TokenService;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Contract\SessionInterface;
use Hyperf\Validation\Rule;

/**
 * @AutoController()
 */
class MemberController
{
    /**
     * @Inject()
     * @var MemberService
     */
    private $memberService;

    /**
     * @Inject()
     * @var TokenService
     */
    private $tokenService;

    /**
     * @Inject()
     * @var \Hyperf\Contract\SessionInterface
     */
    private $session;

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }

    /**
     * @RequestMapping(path="register", methods="get,post")
     */
    public function register(RegisterRequest $request)
    {
        try {
            $username = (string)$request->input('username');
            $password = (string)$request->input('password');
            $this->memberService->register($username, $password);
        }catch (\Exception $e)
        {
            throw new  \App\Exception\BusinessException(500,$e->getMessage());
        }
        return [];
    }

    /**
     * @RequestMapping(path="login", methods="get,post")
     */
    public function login(LoginRequest $request)
    {
        $username = (string)$request->input('username');
        $password = (string)$request->input('password');
        $member = $this->memberService->login($username,$password);

        $token = $this->tokenService->create($member->id);
        return [
            'token' => $token,
        ];
    }

    /**
     * @RequestMapping(path="status", methods="get,post")
     */
    public function status(RequestInterface $request)
    {
        $token = $request->header('X-Session-Id',null);
        if ( empty($token) )
        {
            throw new NoLoginException();
        }
        return [ 'data' => $this->tokenService->getMemberInfo($token)];
    }
}
