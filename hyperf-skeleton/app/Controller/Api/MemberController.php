<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AbstractController;
use App\Request\Api\LoginRequest;
use App\Request\Api\RegisterRequest;
use App\Service\MemberService;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\Di\Annotation\Inject;

/**
 * @AutoController()
 */
class MemberController  extends AbstractController
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
     * @RequestMapping(path="/register", methods="get,post")
     * @param RegisterRequest $request
     */
    public function register(RegisterRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $this->memberService->register($username,$password);
    }

    /**
     * @RequestMapping(path="/login", methods="get,post")
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        $this->memberService->login($request->username,$request->password);
        return [
            'token' => $this->session->getId(),
        ];
    }

}

