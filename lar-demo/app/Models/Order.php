<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const WAIT_PAY_CONFIRM = 0;
    const WAIT_SEND = 1;

    const STATUS = [
        self::WAIT_PAY_CONFIRM => '待付款',
        self::WAIT_SEND => '待发货',
    ];

    const EXPIRE_TIME = 10;


    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 判断订单号字段no是否为空，为空的话调用订单号生成方法
            if (!$model->order_num)
            {
                $model->order_num = static::createOrderNum();
                // 如果生成失败，就返回false
                if (!$model->order_num)
                {
                    return false;
                }
            }
            $model->status = self::WAIT_PAY_CONFIRM;
        });
    }




    public static function createOrderNum()
    {
        // 订单流水号前缀
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++)
        {
            // 随机生成 6 位的数字
            $order_num = $prefix.str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('order_num', $order_num)->exists())
            {
                return $order_num;
            }
        }
        return false;
    }




}
