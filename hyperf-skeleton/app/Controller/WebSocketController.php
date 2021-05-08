<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\MemberService;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Swoole\Http\Request;
use Swoole\Server;
use Swoole\Websocket\Frame;
use Swoole\WebSocket\Server as WebSocketServer;
use Hyperf\Di\Annotation\Inject;

use Hyperf\WebSocketServer\Context;


class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    public static $online = [];


    /**
     * @Inject()
     * @var MemberService
     */
    private $memberService;

    public function onMessage($server, Frame $frame): void
    {

        $member = Context::get('member');

        $server->push($frame->fd, 'Recv: ' . $frame->data);
        $server->push($frame->fd, '你是,id:'.$member->id."的用户");
    }

    public function onClose($server, int $fd, int $reactorId): void
    {
        var_dump('closed');
    }

    public function onOpen($server, Request $request): void
    {

        var_dump($request->header);
        var_dump($request->get);

        if (!isset($request->get['token']) || empty($request->get['token']))
        {
            $server->push($request->fd, '您未登陆');
        }

        if (!isset($request->get['token']) || empty($request->get['token']))
        {
            $server->push($request->fd, '您未登陆');
        }
        $token = $request->get['token'];
        try{
            $member = $this->memberService->getByToken($token);
            Context::set('member', $member);
        }catch (\Exception $e)
        {
            $server->push($request->fd,$e->getMessage());
        }



        $server->push($request->fd, '您好呀,id:'.$member->id."的用户");
    }


}
