<?php
namespace App\PHP;

class Client
{
    //授权类型
    protected $response_type = '';
    //客户端的ID
    protected $client_id = '';
    //重定向URI
    protected $redirect_uri = '';
    //申请的权限范围
    protected $scope = '';
    //客户端的当前状态
    protected $state = '';

}