<?php


namespace App\Service;

use App\Model\ConnectMap;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\ApplicationContext;
use Hyperf\WebSocketServer\Context;
use Hyperf\WebSocketServer\Context as WsContext;

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
    public function bind (int $fd,int $member_id)
    {
        echo __FUNCTION__."\n";
        if ( $this->connectMap->where('fd',$fd)->exists() )
        {
            echo "有fd:{$fd}\n";
            $map = $this->connectMap->where(['fd'=>$fd])->update(['member_id'=>$member_id]);
        }else
        {
            echo "无fd:{$fd}\n";
            $map = $this->connectMap->insert(['fd'=>$fd,'member_id'=>$member_id]);
        }
        if ($map)
        {
            Context::set("member_id",$member_id);
        }
        return $map;
    }

    /**解绑fd
     * @param int $fd
     * @return int
     */
    public function unbind (int $fd):int
    {
        Context::destroy("member_id");
        return $this->connectMap->where('fd',$fd)
                                ->update(['member_id'=>0]);
    }

    public function memberId()
    {
        return (int)Context::get('member_id');
    }

    public function fd()
    {
        return (int)\Hyperf\Utils\Context::get(WsContext::FD);
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
        return $this->connectMap->where(['member_id'=>$member_id])->get('fd');
    }

}