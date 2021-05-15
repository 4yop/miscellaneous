<?php


namespace App\Model;


class MemberToken extends Model
{
    protected $fillable = [
        'member_id',
        'token',
    ];

//    public function member()
//    {
//        return $this->belongsTo(Member::class,'member_id','id');
//    }

}