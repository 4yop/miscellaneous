<?php

declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class MessageCode extends AbstractConstants
{
    /**
     * @Message("Server Error！")
     */
    const SERVER_ERROR = 500;

    /**
     * @Message("成功")
     */
    const SUCCESS = 0;

    /**
     * @Message("未登录")
     */
    const NO_LOGIN = 403;

    /**
     * @Message("找不到")
     */
    const NOT_FOUND = 404;

    /**
     * @Message("参数有误")
     */
    const INVALID = 417;
}
