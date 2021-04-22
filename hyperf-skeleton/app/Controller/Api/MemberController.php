<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Service\MemberService;
use App\Request\LoginRequest;
use App\Request\RegisterRequest;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Contract\SessionInterface;
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
        $username = $request->input('username');
        $password = $request->input('password');
        $this->memberService->register($username,$password);
        return [];
    }

    /**
     * @RequestMapping(path="login", methods="get,post")
     */
    public function login(LoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $member = $this->memberService->login($username,$password);
        //$this->session->set('member', $member);
        return [
            //'x-session-id'=>$this->session->getId()
        ];
    }

}
