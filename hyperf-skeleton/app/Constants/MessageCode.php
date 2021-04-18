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
     * @Message("错误")
     */
    const ERROR = 500;

    /*
     * @Message("成功");
     */
    const SUCCESS = 0;

    /*
     * @Message("未找到记录");
     */
    const NOT_FOUND = 404;

    /*
     * @Message("未登录");
     */
    const MEMBER_NO_LOGIN = 1001;
}
