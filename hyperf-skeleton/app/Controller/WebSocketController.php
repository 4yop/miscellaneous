<?php
declare(strict_types=1);

namespace App\Controller;

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
    }

    public function onClose($server, int $fd, int $reactorId): void
    {
        var_dump('closed');
    }

    public function onOpen($server, Request $request): void
    {
        $fd = $request->fd;
        if ( !isset($request->get['_sessionId']) || empty($request->get['_sessionId']) )
        {
            echo "没 sessionId\n";
            $server->close($fd);
            return;
        }
        echo "握手\n";


        $tokenService = new TokenService();
        $binderService = new BinderService();
        $token = $request->get['_sessionId'];

        if (!$member = $tokenService->getMemberInfo($token))
        {
            $server->close($fd);
            echo "member 为空 \n";
            return;
        }

        if ( !$binderService->bind($fd,$member->id) )
        {
            $server->close($fd);
            echo "绑定 fd:{$fd} 和 member_id:{$member->id} 失败\n";
            return;
        }

        $server->push($request->fd, '');
    }
}

