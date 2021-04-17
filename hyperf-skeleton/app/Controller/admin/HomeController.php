<?php

declare(strict_types=1);

namespace App\Controller\admin;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;



class HomeController extends BaseController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        return $this->view("index");
    }
}
