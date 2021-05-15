<?php

declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class GobangStatus extends AbstractConstants
{

    /**
     * @Message("等待开始")
     */
    const WAIT_START = 1;

    /**
     * @Message("游戏中")
     */
    const GAMING = 2;
}
