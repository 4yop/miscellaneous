<?php

namespace App\Http\Controllers\PHP\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Redis;
use phpseclib3\Crypt\Random;
use Ramsey\Uuid\Uuid;


class QrCodeLoginController extends Controller
{
    //登录页面
    public function index(Request $request)
    {
        $user = $request->session()->get("user");
        if ($user)
        {
            print_r($user);
            return "<h1>已登录了</h1>";
        }
        return view('php.demo.qr_code_login.login');
    }

    //获取二维码
    public function getQrCode(Request $request)
    {
        if ($request->session()->get("user"))
        {
            return response()->json(['code'=>0]);
        }

        $token = $request->session()->get('token');
        if (!empty($token))
        {
            $this->delCode($token);
        }

        $token = (string)Uuid::uuid4();
        $request->session()->put('token',$token);
        $data =  route("qr_code_login.login",['token'=>$token]);

        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create($data)
                        ->setEncoding(new Encoding('UTF-8'))
                        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                        ->setSize(300)
                        ->setMargin(10)
                        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                        ->setForegroundColor(new Color(0, 0, 0))
                        ->setBackgroundColor(new Color(255, 255, 255));




        $result = $writer->write($qrCode);
        $full_name = "img/code/".md5($token).".png";
        touch($full_name);
        $result->saveToFile($full_name);
        return response()->json(['code'=>1,'data'=> [ 'qr_code'=> "/".$full_name] ]);
    }

    public function delCode(string $token)
    {
        if (file_exists("img/code/{$token}.png"))
        {
            unlink("img/code/{$token}.png");
        }

    }

    //检查是否扫码了
    public function check(Request $request)
    {
        if ($request->session()->get("user"))
        {
            return response()->json(['code'=>1]);
        }

        $token = $request->session()->get('token');
        if (!$token){
            return response()->json(['code'=>0]);
        }
        $user = Cache::pull("user-token:{$token}");
        if ($user)
        {
            $request->session()->put("user",$user);
            $this->delCode($token);
        }

        return response()->json(['code'=>$user?1:0 ]);
    }

    //登录
    public function login(Request $request)
    {
        if ( !$token = $request->input("token") )
        {
            return "<h1>token 无效</h1>";
        }
        $file = "img/code/".md5($token).".png";
        if( !file_exists($file) )
        {
            return "<h1>token 无效1</h1>";
        }

        if ( time() - filectime($file) > 15 )
        {
            $this->delCode($token);
            return "<h1>token 无效2</h1>";
        }


        /**
         * 先要判断扫码这个端是否登录了，没登陆要登录后，再扫
         */
        //模拟用户信息，真正用要改成自己的用户逻辑
        $user = [
            'user_id'      => random_int(1,999),
            'access_token' => md5(Uuid::uuid1()),
            'name'         => '随机用户',
        ];
        Cache::put("user-token:{$token}",$user);
        $this->delCode($token);
        return "<h1>扫码登录成功</h1>";
    }
}
