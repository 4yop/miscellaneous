<?php


namespace App\Service;


use Hyperf\Utils\Context;
use Hyperf\WebSocketServer\Context as WsContext;
use Hyperf\WebSocketServer\Server;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use Hyperf\Di\Annotation\Inject;

class WebSocketService extends Server
{
    /**@inject
     * @var MemberService
     */
    private $memberService;

    /**@inject
     * @var TokenService
     */
    private $tokenService;

    /**@inject
     * @var BinderService
     */
    private $binderService;

    /**握手
     * @param SwooleRequest $request
     * @param SwooleResponse $response
     */
    public function onHandShake(SwooleRequest $request, SwooleResponse $response): void
    {
        parent::onHandShake( $request,$response);

        $fd = Context::get(WsContext::FD);

        if ( !isset($request->get['_sessionId']) || empty($request->get['_sessionId']) )
        {
            $this->getServer()->close($fd);
            return;
        }

        $token = $request->get['_sessionId'];
        var_dump($token);
        $member = $this->tokenService->getByToken($token);

        if ( !$this->binderService->bindNx($member->id,$fd) )
        {
            echo __LINE__."bind nx 失败 \n";
            $this->getServer()->close($fd);
        }

    }
}