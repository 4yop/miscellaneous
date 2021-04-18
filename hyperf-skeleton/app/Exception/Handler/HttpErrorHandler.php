<?php


namespace App\Exception\Handler;


use App\Constants\MessageCode;
use App\Exception\BusinessException;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class HttpErrorHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if ($throwable instanceof BusinessException)
        {
            $code = $throwable->getCode();

            $data = json_encode([
                'code' => $code,
                'message' => $throwable->getMessage(),
            ],JSON_UNESCAPED_UNICODE);

            // 阻止异常冒泡
            $this->stopPropagation();
            return $response
                    ->withHeader('Content-Type', 'text/html;charset=utf-8')
                    ->withStatus(500)
                    ->withBody(new SwooleStream($data));

        }

        // 交给下一个异常处理器
        return $response;
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}