<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constants\MessageCode;
use Hyperf\Server\Exception\ServerException;
use Throwable;

class BusinessException extends ServerException
{
    public function __construct(int $code = MessageCode::SERVER_ERROR, string $message = null, Throwable $previous = null)
    {
        if (is_null($message)) {
            $message = MessageCode::getMessage($code);
        }

        parent::__construct($message, $code, $previous);
    }
}