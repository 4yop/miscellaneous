<?php


namespace App\Exception;


use App\Constants\MessageCode;
use Throwable;

class ParameterException extends BusinessException
{
    public function __construct(int $code = MessageCode::NOT_FOUND, string $message = '参数有误', Throwable $previous = null)
    {
        parent::__construct($code, $message, $previous);
    }
}