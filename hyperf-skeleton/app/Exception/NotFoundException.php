<?php


namespace App\Exception;


use App\Constants\MessageCode;
use Throwable;

class NotFoundException extends BusinessException
{
    public function __construct(string $message = '找不到', int $code = MessageCode::NOT_FOUND, Throwable $previous = null)
    {
        parent::__construct($code, $message, $previous);
    }
}