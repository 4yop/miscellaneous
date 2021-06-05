<?php



//伪代码：生成订单
$data = [
    'order_num' => get_order_num(),//订单号
    'price' => 100.01,//价格
    'create_time' => time(),//下单时间
    'update_time' => 0,//更新时间
    'status' => 0,//订单状态 0为未付款  9为取消
];
$order_id = OrderModel::insertGetId($data);
//待付款订单,设置过期1个小时
redis()->setex("wait_confirm_order_id:{$order_id}", 3600, 1);


//伪代码：订阅键过期时间
redis()->subscribe('__keyevent@0__:expired', function ($key) {
    //判断是否是需要的键名，是否为 wait_confirm_order_id: 开头的
    if (strpos($key, "wait_confirm_order_id:") === 0) {
        $order_id = (int)str_replace("wait_confirm_order_id:", '', $key);

        //判断该订单是否没付款
        $where = [
            'order_id' => $order_id,
            'status' => 0,
        ];
        if (OrderModel::where($where)->exists()) {
            $res = OrderModel::where($where)
                ->update(['status' => 9, 'update_time' => time()]);
            //记录
            log("订单:{$order_id}取消" . ($res ? "成功" : "失败"));
        }
    } else {
        //todo其他操作
    }
});


//伪代码修改
redis()->subscribe('__keyevent@0__:expired', function ($key) {
    //判断是否是需要的键名，是否为 wait_confirm_order_id: 开头的
    if (strpos($key, "wait_confirm_order_id:") === 0) {
        $order_id = (int)str_replace("wait_confirm_order_id:", '', $key);
        //插入前面
        redis()->lpush('expired_order_ids', $order_id);
    } else {
        //todo其他操作
    }
});


//伪代码 取消订单
//将最后边一个弹出
$order_id = (int)redis()->brPop("expired_order_ids");
if ($order_id) {
    //判断该订单是否没付款
    $where = [
        'order_id' => $order_id,
        'status'   => 0,
    ];
    if ( OrderModel::where($where)->exists() )
    {
        $res = OrderModel::where($where)
            ->update(['status'=>9,'update_time'=>time()]);
        //记录
        log("订单:{$order_id}取消".($res?"成功":"失败"));
    }
}