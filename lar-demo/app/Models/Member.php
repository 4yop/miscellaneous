<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{

    public $timestamps = false;
    protected $table = "ims_qidian_sqlife_member";

    public function first_user()
    {
        return $this->hasOne(Member::class,'member_id','first_userid');
    }

    public function second_user()
    {
        return $this->hasOne(Member::class,'member_id','second_userid');
    }

    public function third_user()
    {
        return $this->hasOne(Member::class,'member_id','third_userid');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];
}
