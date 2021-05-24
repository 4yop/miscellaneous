<?php
declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class MemberType extends AbstractConstants
{
    /**
     * @Message("观战者")
     */
    const WATCH = 2;

    /**
     * @Message("玩家")
     */
    const PLAYER = 1;
}