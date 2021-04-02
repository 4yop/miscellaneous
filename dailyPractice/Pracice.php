<?php
namespace dailyPractice;



class Pracice
{
    /**
     * @var array
     */
    protected static $classList = [
        'dp' => \designPattern\designPatternService::class,
    ];

    protected static $class = null;

    public function __construct(string $key)
    {
        if (!isset(self::$classList[$key])) {
            throw new \InvalidArgumentException("key:{$key} not allow ".__CLASS__.__LINE__);
        }
        self::$class = self::$classList[$key];
    }


    public function create()
    {
        return (self::$class)::createPractice();
    }

    public function test()
    {
        return (self::$class)::testPractice();
    }

}