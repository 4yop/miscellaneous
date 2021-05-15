<?php


namespace App\Service;


use Hyperf\Utils\Context;
use Hyperf\WebSocketServer\Context as WsContext;
use Hyperf\WebSocketServer\Server;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use Hyperf\Di\Annotation\Inject;
use App\Service\TokenService;
use Swoole\WebSocket\Frame;

class WebSocketService extends Server
{

    /**握手
     * @param SwooleRequest $request
     * @param SwooleResponse $response
     */
    public function onHandShake(SwooleRequest $request, SwooleResponse $response): void
    {
        parent::onHandShake( $request,$response);





    }

    public function onMessage($server, Frame $frame): void
    {
        parent::onMessage($server, $frame); // TODO: Change the autogenerated stub

    }


    public function onClose($server, int $fd, int $reactorId): void
    {
        $binderService = new BinderService();
        $binderService->unbind($fd);

        parent::onClose($server, $fd, $reactorId); // TODO: Change the autogenerated stub
    }
}