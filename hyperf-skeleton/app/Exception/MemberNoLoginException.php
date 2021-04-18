<?php


namespace App\Exception;


use App\Constants\MessageCode;
use Throwable;

class MemberNoLoginException extends BusinessException
{
    public function __construct(int $code = MessageCode::MEMBER_NO_LOGIN, string $message = '未登录', Throwable $previous = null)
    {
        parent::__construct($code, $message, $previous);
    }
}