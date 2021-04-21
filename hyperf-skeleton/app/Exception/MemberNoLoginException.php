<?php


namespace App\Exception;


use App\Constants\MessageCode;
use Throwable;

class MemberNoLoginException extends BusinessException
{
    public function __construct(string $message = '未登录',int $code = MessageCode::MEMBER_NO_LOGIN,  Throwable $previous = null)
    {
        parent::__construct($code, $message, $previous);
    }
}