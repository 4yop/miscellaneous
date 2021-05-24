<?php


namespace App\Model;


class Room extends Model
{
    public function creator()
    {
        return $this->hasOne(Member::class,'id','create_user_id');
    }




}