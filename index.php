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

    print_r($argv);


$argv[1];
$argv[2];

    if ($argv[1] === 'pracice' && $argv[2] !== null)
    {
        (new \dailyPractice\Pracice($argv[2]))->create();
    }



