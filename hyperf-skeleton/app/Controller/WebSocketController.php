<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\ActionService;
use App\Service\BinderService;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Hyperf\Utils\Context;
use Hyperf\WebSocketServer\Context as WsContext;
use Swoole\Http\Request;
use Swoole\Server;
use Swoole\Websocket\Frame;
use Swoole\WebSocket\Server as WebSocketServer;
use Hyperf\Di\Annotation\Inject;
use App\Service\TokenService;

class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    /**
     * @Inject()
     * @var BinderService
     */
    private $binder;



    public function onMessage($server, Frame $frame): void
    {
        echo "消息事件\n";
//        var_dump($frame->data);

        $fd = $frame->fd;

        $member_id = $this->binder->getMemberIdByFd($fd);

        $server->push($frame->fd, "fd:$fd --------member_id:$member_id");


        $data_arr = json_decode($frame->data,true);
        if ( empty( $frame->data ) || empty($data_arr) )
        {
            pushError('data 为空');
            return;
        }
        if ( !isset($data_arr['action']) || empty($data_arr['action']) )
        {
            pushError('data的action为空');
            return;
        }

        $action = new ActionService();

        $res = $action->doAction($data_arr);

        pushSucc('成功',$res);

    }

    public function onClose($server, int $fd, int $reactorId): void
    {
        var_dump('closed');
    }

    public function onOpen($server, Request $request): void
    {
        $member_id = $this->binder->getMemberIdByFd($request->fd);
        $content = "fd:{$request->fd}的member_id为{$member_id}";
        pushJson($content);
    }




}

