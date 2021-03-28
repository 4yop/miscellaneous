<?php
    //连接数据库
    header('content-type:text/html;charset=utf-8');

    $dsn = "mysql:host=localhost;dbname=queue_task";

    try{
        $conn = new PDO($dsn,'root','root');
        $conn->exec("SET NAMES utf8");
    }catch (PDOException $e){
        exit("数据库连接失败,{$e->getMessage()}");
    }