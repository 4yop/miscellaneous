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
use App\Model\MemberToken;
use Hyperf\Di\Annotation\Inject;
use Hyperf\DbConnection\Db;
use Psr\SimpleCache\CacheInterface;
use Hyperf\Utils\ApplicationContext;
use Carbon\Carbon;

class IndexController extends AbstractController
{
    /**
     * @Inject()
     * @var MemberModel
     */
    private $memberModel;

    /**
     * @Inject()
     * @var MemberToken
     */
    private $memberToken;

    public function index()
    {
        $now =  Carbon::now();

        

        $member_id = rand(0,999);
        if ( !$member = $this->memberToken->where(['member_id'=>$member_id])->first() )
        {
            $member = $this->memberToken;
        }


        $member->created_at = $now->toDateTimeString();
        $member->expired_at = $now->add(1,'day')->toDateTimeString();
        $member->token = date('Y-m-d H:i:s');
        $member->member_id = $member_id;
        $member->save();

        //return $member;






        $cache = cache();

        try {
            $cache->set('aaa','bbb');

            $a = $cache->get('aaa');
            var_dump($a);

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
