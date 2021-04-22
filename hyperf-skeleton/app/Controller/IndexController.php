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
use Hyperf\DbConnection\Db;
class IndexController extends AbstractController
{
    public function index()
    {
        try {
            $user = $this->request->input('user', 'Hyperf');
            $method = $this->request->getMethod();
            $users = Db::table('users')->get();
            return [
                'method' => $method,
                'message' => "Hello {$user}.",
                'users' => $users,
            ];
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
