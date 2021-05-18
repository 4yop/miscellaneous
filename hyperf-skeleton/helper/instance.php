<?php

use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Context;
use Hyperf\WebSocketServer\Context as WsContext;
use Psr\SimpleCache\CacheInterface;

/**
 * @return mixed|CacheInterface
 */

if (!function_exists('container')) {
    function container()
    {
        return ApplicationContext::getContainer();
    }
}


function cache()
{
    return ApplicationContext::getContainer()->get(CacheInterface::class);
}

if (!function_exists('server')) {
    /**
     * @return \Swoole\Coroutine\Server|\Swoole\Server
     */
    function server()
    {
        return container()->get(\Hyperf\Server\ServerFactory::class)->getServer()->getServer();
    }
}

function pushError (string $message = '',array $data = [],$fd = null)
{
    pushJson ($message,$data,1,$fd);
}

function pushSucc (string $message = '',array $data = [],$fd = null)
{
    pushJson ($message,$data,0,$fd);
}


function pushJson (string $message = '',array $data = [],int $code=0,$fd = null)
{
    $server = server();
    if ($fd === null)
    {
        $fd = Context::get(WsContext::FD);
    }

    $res = [
        'code'    => $code,
        'message' => $message,
    ];

    foreach ($data as $k=>$v)
    {
        $res[$k] = $v;
    }

    $json = json_encode($res);
    $server->push($fd,$json);
}