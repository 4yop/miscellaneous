<?php

interface Math{
    function cacl($op1,$op2);
}

class MathAdd implements Math{
    public function cacl($op1,$op2){
        return $op1 + $op2;
    }
}

class MathSub implements Math{
    public function cacl($op1,$op2){
        return $op1 - $op2;
    }
}

class MathMult implements Math{
    public function cacl($op1,$op2){
        return $op1 * $op2;
    }
}

class MathDivi implements Math{
    public function cacl($op1,$op2){
        return $op1 / $op2;
    }
}

class Jisuan{
    protected $type = null;

    public function __construct($type)
    {
        $type = ucwords($type);
        $CaclType = "Math{$type}";
        if ($this->type === null){
            $this->type = new $CaclType();
        }
    }

    public function cacl($op1,$op2){
        return $this->type->cacl($op1,$op2);
    }
}



$type = 'add';
$op1= 111;
$op2= 222;
$math = new Jisuan($type);
echo $math->cacl($op1,$op2);