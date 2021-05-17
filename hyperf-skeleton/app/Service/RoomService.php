<?php


namespace App\Service;


use App\Constants\GobangStatus;
use App\Exception\BusinessException;
use App\Model\Room;
use Hyperf\Utils\Context;
use Hyperf\Di\Annotation\Inject;
use Hyperf\DbConnection\Db;
use App\Model\RoomMember;

class RoomService
{
    /**Inject();
     * @var App\Model\Room
     */
    private $roomModel;

    /**Inject();
     * @var App\Model\RoomMember
     */
    private $roomMemberModel;


    public function create(int $member_id,string $title):Room
    {

        if (RoomMember::where('member_id',$member_id)->exists())
        {
            throw new BusinessException(500,'已在房间中，无法创建房间');
        }


        Db::beginTransaction();
        try{

            // Do something...
            $room_id = Room::insertGetId([
                'title'   => $title,
                'creator' => $member_id,
                'status'  => GobangStatus::WAIT_START,
            ]);

            RoomMember::insert([
                'room_id' => $room_id,
                'member_id' => $member_id,
            ]);
            Db::commit();
        } catch(\Throwable $ex){
            Db::rollBack();
        }


        return [
            'title'   => $title,
            'creator' => $member_id,
            'status'  => GobangStatus::WAIT_START,
            'room_id' => $room_id,
        ];
    }
}