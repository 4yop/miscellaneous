<?php

/**工厂模式：工厂方法或者类生成对象，而不是在代码中直接new。
使用工厂模式，可以避免当改变某个类的名字或者方法之后，在调用这个类的所有的代码中都修改它的名字或者参数。
 * Interface AnimalInterface
 */
interface AnimalInterface {
    public function create($className);
}

interface Behavior {
    public function __construct();
    public function eat();
    public function sound();
}

class Cat implements Behavior {
    public $msg = '';
    public function __construct()
    {
        $this->msg .= '我是猫';
    }

    public function eat() {
        return $this->msg .= '吃鱼';
    }

    public function sound() {
        return $this->msg .= '声音喵喵喵';
    }
}

class Dog implements Behavior {
    public $msg = '';
    public function __construct()
    {
        $this->msg .= "我是狗";
    }

    public function eat() {
        return $this->msg .= '吃骨头';
    }

    public function sound() {
        return $this->msg .= '声音汪汪汪';
    }
}

class Animal implements AnimalInterface
{
    public function create($class_name)
    {
        $class_map = [
            'dog' => new Dog(),
            'cat' => new Cat(),
        ];
        if (array_key_exists($class_name,$class_map)) {
            return $class_map[$class_name];
        }
        throw new Exception('没这个类');
    }
}


$A = new Animal();

$cat = $A->create('cat');

echo $cat->sound();