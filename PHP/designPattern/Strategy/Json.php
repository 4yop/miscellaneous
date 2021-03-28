<?php


namespace designPattern\Strategy;


class Json implements ConvertInterface
{
    public function serialize(array $data): string
    {
        return json_encode($data);
    }

    public function unserialize(string $string):array
    {
        return json_decode($string,true);
    }
}