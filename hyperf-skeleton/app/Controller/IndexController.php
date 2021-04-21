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
use App\Model\Member;
use Hyperf\Utils\Arr;
use Hyperf\DbConnection\Db;
class IndexController extends AbstractController
{

    public function index()
    {
        // 启用 SQL 数据记录功能
//        Db::enableQueryLog();
//        try{
            $a = new Member();
            $a->username = 1;
            $a->password = 2;
            $r = $a->save();



//        }catch (\Exception $e){
//            return $e;
//        }




        // 打印最后一条 SQL 相关数据
        //var_dump(Arr::last(Db::getQueryLog()));
        //throw new MemberNoLoginException();
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'data' => "Hello {$user}.",
        ];
    }
}
