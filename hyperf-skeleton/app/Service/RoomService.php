<?php


namespace App\Service;


use App\Constants\GobangStatus;
use App\Exception\BusinessException;
use App\Model\Room;
use Hyperf\Utils\Context;
use Hyperf\Di\Annotation\Inject;

class RoomService
{
    /**Inject();
     * @var \App\Model\Room
     */
    private $roomModel;


    public function create(int $member_id,string $title):Room
    {
        $roomId = $this->roomModel->where(['creator'=>$member_id])->value('id');

        if ($roomId)
        {
            throw new BusinessException(500,'已在房间中，无法创建房间');
        }

        $this->roomModel->title = $title;
        $this->roomModel->creator = $member_id;
        $this->roomModel->status = GobangStatus::WAIT_START;
        $this->roomModel->save();

        return $this->roomModel;
    }
}