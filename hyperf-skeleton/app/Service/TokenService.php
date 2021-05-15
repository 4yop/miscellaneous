<?php


namespace App\Service;


use App\Exception\NotFoundException;
use App\Model\Member;
use App\Model\MemberToken;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\Context;
use Carbon\Carbon;



class TokenService
{
    /**
     * @Inject()
     * @var MemberToken
     */
    private $memberToken;

    /**更新或创建token
     * @param int $member_id
     * @return string
     */
    public function create (int $member_id):string
    {
        $token = md5(uniqid().time().uniqid().$member_id);
        $now =  Carbon::now();
        if ( !$member = $this->memberToken->where(['member_id'=>$member_id])->first() )
        {
            $member = $this->memberToken;
        }
        $member->created_at = $now->toDateTimeString();
        $member->expired_at = $now->add(1,'day')->toDateTimeString();
        $member->token      = $token;
        $member->member_id  = $member_id;
        $member->save();
        return $token;
    }


    /**获取用户id 根据token
     * @param string $token
     * @return \Hyperf\Utils\HigherOrderTapProxy|\Illuminate\Support\HigherOrderTapProxy|mixed|void
     */
    public function getMemberId (string $token):int
    {
        return (int)$this->memberToken->where('token',$token)->value('member_id');
    }

    /**
     * @param string $token
     * @return \Hyperf\Utils\HigherOrderTapProxy|\Illuminate\Support\HigherOrderTapProxy|mixed|void|null
     */
    public function getMemberInfo (string $token)
    {
        $memberToken = $this->memberToken->where('token',$token)->first();
        if (!$memberToken)
        {
            return null;
        }
        return Member::where('id',$memberToken['member_id'])->first();

    }



}