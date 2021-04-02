<?php


namespace designPattern\DependencyInjection;


class Test
{
    public function __construct()
    {
        $config = new DatabaseConfiguration("127.0.0.1",3306,'root','root');
        $connect = new DatabaseConnection($config);
        echo $connect->getDsn();
    }
}