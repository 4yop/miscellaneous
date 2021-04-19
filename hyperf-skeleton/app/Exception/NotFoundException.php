<?php


namespace App\Exception;


use App\Constants\MessageCode;
use Throwable;

class NotFoundException extends BusinessException
{
    public function __construct(int $code = MessageCode::NOT_FOUND, string $message = '找不到', Throwable $previous = null)
    {
        parent::__construct($code, $message, $previous);
    }
}