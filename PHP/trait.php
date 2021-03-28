<?php

class Base {
    public static function say1() {
        return "hello";
    }
}

trait BaseTrait{
    public static function say () {
        $a = parent::say1();
        return $a."--sfdsf--\n";
    }
}

class Test extends Base {
    use BaseTrait;
}


//$test = new Test();
//$a = $test->say();
//echo $a;
echo Test::say();