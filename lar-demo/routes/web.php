<?php

use App\Http\Controllers\RabbitMQController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PHP\Demo\QrCodeLoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return "HI\n";
    return view('welcome');
});

Route::get('order/place',[\App\Http\Controllers\OrderController::class,'place'])->name('order.place');


Route::get('/login', [\App\Http\Controllers\PHP\Demo\SsoLogin::class,'index']);

Route::prefix('php/demo/qr_code_login')->group(function () {
    Route::get('/',[QrCodeLoginController::class,'index']);

    Route::get('code',[QrCodeLoginController::class,'getQrCode'])->name('qr_code_login.code');

    Route::get('login',[QrCodeLoginController::class,'login'])->name('qr_code_login.login');

    Route::get('check',[QrCodeLoginController::class,'check'])->name('qr_code_login.check');
});

Route::prefix('rabbit_mq')->group(function(){
    Route::get('/',[RabbitMQController::class,'test1']);
});


Route::get("/member",[\App\Http\Controllers\MemberController::class,'index'])->name("member.index");

