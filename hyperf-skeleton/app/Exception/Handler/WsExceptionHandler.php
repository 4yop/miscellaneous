<?php


namespace App\Exception\Handler;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Utils\Context;
use Hyperf\WebSocketServer\Context as WsContext;
use Psr\Http\Message\ResponseInterface;
use App\Exception\BusinessException;
use Throwable;

class WsExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        // 判断被捕获到的异常是希望被捕获的异常
        //if ($throwable instanceof BusinessException) {
            // 格式化输出
            $data = json_encode([
                'code' => $throwable->getCode(),
                'message' => $throwable->getMessage(),
            ], JSON_UNESCAPED_UNICODE);
            $fd = Context::get(WsContext::FD);
            server()->push($fd,$data);

            return;
            // 阻止异常冒泡
//            $this->stopPropagation();
//            return $response->withStatus(500)
//                            ->withHeader("Content-type","application/json; charset=utf-8")
//                            ->withBody(new SwooleStream($data));
        //}

        // 交给下一个异常处理器
      //  return $response;

        // 或者不做处理直接屏蔽异常
    }

    /**
     * 判断该异常处理器是否要对该异常进行处理
     */
    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}