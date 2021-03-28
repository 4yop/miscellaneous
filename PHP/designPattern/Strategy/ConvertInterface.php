<?php


namespace designPattern\Strategy;


interface ConvertInterface
{
    public function serialize(array $data);

    public function unserialize(string $string);
}