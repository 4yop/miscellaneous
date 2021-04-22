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
use App\Exception\BusinessException;
use App\Exception\NoLoginException;
use App\Exception\NotFoundException;
use App\Model\Member as MemberModel;
use Hyperf\Di\Annotation\Inject;
use Hyperf\DbConnection\Db;
class IndexController extends AbstractController
{
    /**
     * @Inject()
     * @var MemberModel
     */
    private $memberModel;

    public function index()
    {
        //throw new NoLoginException();

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
