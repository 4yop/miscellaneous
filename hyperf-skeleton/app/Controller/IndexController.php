<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\Exception\FooException;
use App\Exception\MemberNoLoginException;
use App\Exception\NotFoundException;

class IndexController extends AbstractController
{

    public function index()
    {
        throw new MemberNoLoginException();
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'data' => "Hello {$user}.",
        ];
    }
}
