<?php

namespace App\Http\Controllers\PHP\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;




class SsoLogin extends Controller
{
    private $app_id = 'dfgdfghsfh';
    private $app_serect = 'sdgdfsertegdfg';
    //登录页面
    public function index(Request $request)
    {
        $type = $request->input('type',null);
        $token = $request->input('token',null);
        if ($type == '4yop')
        {

        }
    }


}
