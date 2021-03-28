<?php


namespace designPattern\Strategy;
use Spatie\ArrayToXml\ArrayToXml;

class Xml implements ConvertInterface
{
    public function serialize(array $data):string
    {
        return ArrayToXml::convert($data);
    }

    public function unserialize(string $string):array
    {
        return xmlToArray($string);
    }
}