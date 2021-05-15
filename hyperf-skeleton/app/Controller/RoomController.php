<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\RoomService;

use Hyperf\Di\Annotation\Inject;

class RoomController extends WebSocketController
{
    /**@Inject()
     * @var RoomService
     */
    private $roomService;

    /**创建房间
     * @param $data
     */
    public function create($data)
    {
        echo __FUNCTION__;
    }
}

