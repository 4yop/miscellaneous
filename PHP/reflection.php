<?php
class A
{
    protected $aaa;
    public function __construct(int $a,string $b,$c,\B $d)
    {

    }

    public function aa()
    {

    }

    public function ab()
    {

    }
    public static function ac()
    {

    }
    protected static function ad()
    {

    }
    private function af()
    {

    }
}
class B
{
    protected $bbb=1;

    /**
     * @return int
     */
    public function getBbb(): int
    {
        return $this->bbb;
    }

    /**
     * @param int $bbb
     */
    public function setBbb(int $bbb): void
    {
        $this->bbb = $bbb;
    }

}



$reflectionClass = new \ReflectionClass(A::class);

if( $reflectionClass->hasMethod("__construct") )
{
    $method = $reflectionClass->getMethod("__construct");
    $methodParameters = $method->getParameters();
    $vars = ['a'=>1,'b'=>2,'c'=>3];
    $p = [];
    foreach ($methodParameters as $parameter) {
        getParames($parameter,$vars);
    }
    var_dump($methodParameters);


}


function getParames(\ReflectionParameter $parameter,array $vars)
{
    $name = $parameter->getName();
    $type = $parameter->getType();
    $default = $parameter->getDefaultValue();

}