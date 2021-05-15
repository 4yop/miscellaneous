<?php


namespace App\Service;

use App\Model\ConnectMap;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\ApplicationContext;
use Hyperf\WebSocketServer\Context;

class BinderService
{
    /**
     * @Inject()
     * @var ConnectMap
     */
    private $connectMap;

    /**绑定 fd 和member_id
     * @param int $fd
     * @param int $member_id
     * @return ConnectMap
     */
    public function bind (int $fd,int $member_id):ConnectMap
    {
        echo __FUNCTION__."\n";
        if ( $this->connectMap->where('fd',$fd)->exists() )
        {
            $map = $this->connectMap->where(['fd'=>$fd])->update(['member_id'=>$member_id]);
        }else
        {
            $map = $this->connectMap->insert(['fd'=>$fd,'member_id'=>$member_id]);
        }
        return $map;
    }

    /**解绑fd
     * @param int $fd
     * @return int
     */
    public function unbind (int $fd):int
    {
        return $this->connectMap->where('fd',$fd)
                                ->update(['member_id'=>0]);
    }

    /**
     * @param int $fd
     * @return int
     */
    public function getMemberIdByFd (int $fd)
    {
        return (int)$this->connectMap->where('fd',$fd)
                                     ->value('member_id');
    }

    public function getFdsByMemberId (int $member_id)
    {
        $this->connectMap->where(['member_id'=>$member_id])->get('fd');
    }

}