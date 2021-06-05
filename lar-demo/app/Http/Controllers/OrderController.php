<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //下单
    public function place(Order $order)
    {
        $res = $order->save();
        var_dump($res);
    }
}
