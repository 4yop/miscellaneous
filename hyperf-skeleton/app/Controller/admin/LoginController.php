<?php

declare(strict_types=1);

namespace App\Controller\admin;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use HyperfExt\Auth\Middlewares\AbstractAuthenticateMiddleware;
class LoginController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw('Hello Hyperf!');
    }
}
