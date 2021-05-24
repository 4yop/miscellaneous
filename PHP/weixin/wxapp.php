<?php


class wxapp
{
    public function getAccessToken ()
    {
        $app_id = 'wxd9a91727b68ca2e0';
        $app_secret = '7a09a24679fae9b2b849f6324d6be29d';
        $format  = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';

        $request = sprintf($format,$app_id,$app_secret);

    }
}