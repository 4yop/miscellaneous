<?php

    //文件
    $file =  "/file/excel/" . md5(date('Y-m-d H:i:s') . uniqid()) . ".csv";

    //打开文件
    $handle = fopen($file, "w");

    //得按照这个顺序
    $title = [
        "A列标题",
        "B列标题",
    ];
    //写入数据
    fputcsv($handle, $title);

    $page = 1;

    $data = [
        [
            "A"=>"A2的数据",
            "B"=>"B2的数据",
        ],
        [
            "A"=>"A3的数据",
            "B"=>"B3的数据",
        ],
    ];

    foreach ($data as $value) {
        //得按照顺序
        $item = [
            $value['A'],
            $value['B'],
        ];
        //写入数据
        fputcsv($handle, $item);
    }

    //关闭文件
    fclose($handle);


    header("Location:{$file}");



    //composer require phpoffice/phpspreadsheet