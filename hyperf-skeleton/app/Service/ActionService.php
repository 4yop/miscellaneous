<?php


namespace App\Service;

use Hyperf\Di\Annotation\Inject;

class ActionService
{
    /**
     * @Inject()
     * @var RoomService
     */
    private $roomService;

    /**
     * @Inject()
     * @var BinderService
     */
    private $bind;



    public function doAction (array $data)
    {
        if ($data['action'] == 'room.create')
        {
            return $this->roomCreate($data);
        }
        else if ($data['action'] == 'room.list')
        {
            return $this->roomService->lists();
        }
        else if ($data['action'] == 'room.join')
        {
            return $this->join($data);
        }
        return [];
    }

    public function roomCreate(array $data)
    {
//        echo $this->bind->memberId().":m_id\n";
//        echo $this->bind->fd().":fd\n";

       $member_id = $this->bind->memberId();
       $room = $this->roomService->create($member_id,$data['title']);

       return ['data'=>$room];
    }

    public function join (array $data)
    {
        $member_id = $this->bind->memberId();
        $room = $this->roomService->join($member_id,$data['roomId']);
        return ['data'=>$room,'do_action'=>'room.join'];
    }


}