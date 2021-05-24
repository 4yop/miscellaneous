<?php


namespace App\Service;


use App\Constants\GobangStatus;
use App\Exception\BusinessException;
use App\Model\Room;
use Hyperf\Utils\Context;
use Hyperf\Di\Annotation\Inject;
use Hyperf\DbConnection\Db;
use App\Model\RoomMember;
use App\Constants\MemberType;

class RoomService
{
    /**Inject();
     * @var Room
     */
    private $roomModel;

    /**Inject();
     * @var \App\Model\RoomMember
     */
    private $roomMemberModel;


    public function create(int $member_id,string $title)
    {

        if (RoomMember::where('member_id',$member_id)->exists())
        {
            pushError('已在房间中，无法创建房间');
            return;
        }


        Db::beginTransaction();
        try{

            // Do something...
            $room_id = Room::insertGetId([
                'title'   => $title,
                'create_user_id' => $member_id,
                'status'  => GobangStatus::WAIT_START,
            ]);

            RoomMember::insert([
                'room_id' => $room_id,
                'member_id' => $member_id,
            ]);
            Db::commit();
        } catch(\Throwable $ex){
            Db::rollBack();
            //throw new BusinessException(500,$ex->getMessage());
            pushError($ex->getMessage()."line:".__LINE__);
            return;
        }


        return [
            'title'   => $title,
            'creator' => $member_id,
            'status'  => GobangStatus::WAIT_START,
            'room_id' => $room_id,
            'action'  => 'room.create',
        ];
    }

    public function lists ()
    {

        $list = Room::with(['creator'])
                    ->get()
                    ->each(function ($item,$key) {
                        $item->statusText = GobangStatus::getMessage($item->status);
                    });
        return [
            'action'    =>  'room.list',
            'list'      =>  $list,
        ];
    }


    public function join (int $member_id,int $room_id):array
    {
        if ( RoomMember::where('member_id',$member_id)->exists() )
        {
            pushError("您已加入其它房间了");
            return [];
        }


        $room = Room::where(['id'=>$room_id])->first();
        if (!$room || $room->person > 1)
        {
            pushError("该房间不存在或满员了");
            return [];
        }

        $data = [
            'member_id' => $member_id,
            'room_id'   => $room_id,
            'type'      => MemberType::PLAYER,
        ];
        try {
            Db::beginTransaction();
            $res1 = Room::where(['id'=>$room_id,'person'=>$room->person])->increment('person');
            if (!$res1)
            {
                pushError("加入失败,".__LINE__);
                Db::rollBack();
                return false;
            }
            RoomMember::insert($data);
            Db::commit();
        }catch (\Exception $e)
        {
            Db::rollBack();
            pushError($e->getMessage()."line:".__LINE__);
            return [];
        }


        return ['roomInfo'=>$room];
    }
}