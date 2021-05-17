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
use Swoole\WebSocket\Server as WebSocketServer;

class WebSocketService extends Server
{

    /**握手
     * @param SwooleRequest $request
     * @param SwooleResponse $response
     */
    public function onHandShake(SwooleRequest $request, SwooleResponse $response): void
    {
        parent::onHandShake( $request,$response);

        $server = $this->getServer();
        //$fd = $request->fd;
        $fd = Context::get(WsContext::FD);
        if ( !isset($request->get['_sessionId']) || empty($request->get['_sessionId']) )
        {

            echo "没 sessionId\n";
            $this->pushJson("没 sessionId\n");
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

    }



    public function onMessage($server, Frame $frame): void
    {
        parent::onMessage($server, $frame); // TODO: Change the autogenerated stub

        $data_arr = json_decode($frame->data,true);
        if ( empty( $frame->data ) || empty($data_arr) )
        {
            $this->pushJson('data 为空');
            return;
        }
        if ( !isset($data_arr['action']) || empty($data_arr['action']) )
        {
            $this->pushJson('data的action为空');
            return;
        }

        $action = new ActionService();

        $res = $action->doAction($data_arr);

        $this->pushJson($res);

    }




    public function onClose($server, int $fd, int $reactorId): void
    {
        $binderService = new BinderService();
        $binderService->unbind($fd);

        parent::onClose($server, $fd, $reactorId); // TODO: Change the autogenerated stub
    }

    /**发送 json格式的消息
     * @param $message string|array|object 消息
     */
    public function pushJson ($message)
    {
        $server = $this->getServer();
        $fd = Context::get(WsContext::FD);
        if ( !is_array($message) && !is_object($message) )
        {
            $message = ['msg'=>$message];
        }
        $json_message = json_encode($message);
        $server->push($fd,$json_message);
    }



}