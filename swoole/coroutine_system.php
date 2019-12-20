<?php
/**
 * 异步文件IO
 */
use Swoole\Coroutine\System;

$file = __DIR__.'/io/1.txt';
// 读取
go(function() use ($file){


    $info = System::statvfs(__DIR__);
    print_r($info);

    $fp = fopen($file,'r');
    $content1 = System::fread($fp,1);

    print_r(['content1' => $content1]);return;

    $content = System::readFile($file);
    print_r(
        [
            '标题' => '异步读取文本',
            '文件' => $file,
            '内容' => $content,
        ]
    );

    $lineArr = array_filter(explode("\n",$content));
    $count = count($lineArr);
    if($count == 0){
        $line = 1;
    }else{
        $line = str_replace('line','',$lineArr[$count - 1]) + 1;
    }
    print_r(
        compact('lineArr','line')
    );
    $writeContent = "line{$line}\n";
    $res = System::writeFile($file,$writeContent,FILE_APPEND);
    print_r([
        [
            '标题' => '写入文本',
            '文件' => $file,
            '内容' => $writeContent,
            '结果' => $res,
        ]
    ]);
});