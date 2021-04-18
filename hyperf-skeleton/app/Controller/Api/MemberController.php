<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AbstractController;
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
    protected $memberService;

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
        $this->memberService($request->username,$request->password);
    }

}
