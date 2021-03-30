<?php

    include 'vendor/autoload.php';


    const ROOT_PATH = __DIR__;
    const PHP_PATH = ROOT_PATH."/PHP/";

//    use designPattern\Singleton;

//    $class = Singleton::getInstace();
//
//    var_dump($class);
//
//    new \designPattern\Observer\ObserverTest();
//
//    new \designPattern\Factory\FactoryTest();
//
//    new \designPattern\Iterator\IteratorTest();
//
//    new \designPattern\Registry\RegistryTest();
//
//    new \designPattern\Adapter\AdapterTest();
//
//    new \designPattern\Strategy\StrategyTest();
//
//
    new \designPattern\DependencyInjection\Test();
    //print_r($argv);


    if (!isset($argv[3]))
    {
        $argv[3] = 'create';
    }

    if ($argv[1] === 'pracice' && $argv[2] !== null && $argv[3] == 'create')
    {
        (new \dailyPractice\Pracice($argv[2]))->create();
    }

    //php index.php  pracice dp test
    if ($argv[1] === 'pracice' && $argv[2] !== null && $argv[3] == 'test')
    {
        (new \dailyPractice\Pracice($argv[2]))->test();
    }



