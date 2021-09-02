<?php

//    //文件
//    $file =  "/file/excel/" . md5(date('Y-m-d H:i:s') . uniqid()) . ".csv";
//
//    //打开文件
//    $handle = fopen($file, "w");
//
//    //得按照这个顺序
//    $title = [
//        "A列标题",
//        "B列标题",
//    ];
//    //写入数据
//    fputcsv($handle, $title);
//
//    $page = 1;
//
//    $data = [
//        [
//            "A"=>"A2的数据",
//            "B"=>"B2的数据",
//        ],
//        [
//            "A"=>"A3的数据",
//            "B"=>"B3的数据",
//        ],
//    ];
//
//    foreach ($data as $value) {
//        //得按照顺序
//        $item = [
//            $value['A'],
//            $value['B'],
//        ];
//        //写入数据
//        fputcsv($handle, $item);
//    }
//
//    //关闭文件
//    fclose($handle);
//
//
//    header("Location:{$file}");


    var_dump(getimagesize("sososos.png"));

    echo "压缩前:".filesize("sososos.png")."\n";

    com(100);
    com(50);
    com(10);
    com(1);
    function com ($q = 50) {
        $file = "sososos.png";
        $img = new \Imagick($file);
        $img->setImageFormat("jpg");
        $img->setImageCompressionQuality($q);
        //$img->setImageFormat(pathinfo($file,PATHINFO_EXTENSION));
        $save = "{$file}-{$q}-compress.jpg";
        touch($save);
        $res = $img->writeImage($save);
        echo "{$q}压缩后 :".filesize($save)."\n";
    }





    exit;
    $a = [''=>1];
    var_dump(isset($a['']));
    echo $a[''];
    var_dump($a);exit;



    //composer require phpoffice/phpspreadsheet


    redis()->subscribe('__keyevent@0__:expired',function ($key) {
        //判断是否是需要的键名，是否为 wait_confirm_order_id: 开头的
        if (strpos($key,"wait_confirm_order_id:") === 0)
        {
            $order_id = (int)str_replace("wait_confirm_order_id:",'',$key);
            //插入前面
            redis()->lpush('expired_order_ids',$order_id);
        }else
        {
            //todo其他操作
        }
    });



    //将最后边一个弹出
    $order_id = (int)redis()->brPop("wait_confirm_order_id:");
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
