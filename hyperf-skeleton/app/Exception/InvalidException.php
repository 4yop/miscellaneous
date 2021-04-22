<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\MessageCode;
use Throwable;

class InvalidException extends BusinessException
{
    public function __construct(string $message = '', int $code = MessageCode::INVALID, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = MessageCode::getMessage($code);
        }
        parent::__construct($code,$message,$previous);
    }
}