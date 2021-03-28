<?php

    include 'vendor/autoload.php';

    use designPattern\Singleton;

//    $class = Singleton::getInstace();
//
//    var_dump($class);

    new \designPattern\Observer\ObserverTest();

    new \designPattern\Factory\FactoryTest();

    new \designPattern\Iterator\IteratorTest();

    new \designPattern\Registry\RegistryTest();

    new \designPattern\Adapter\AdapterTest();

    new \designPattern\Strategy\StrategyTest();