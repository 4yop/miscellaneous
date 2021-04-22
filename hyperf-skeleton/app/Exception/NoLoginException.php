<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\MessageCode;
use Throwable;

class NoLoginException extends BusinessException
{
    public function __construct(string $message = null, int $code = MessageCode::NO_LOGIN, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = MessageCode::getMessage($code);
        }
        parent::__construct($code,$message,$previous);
    }
}