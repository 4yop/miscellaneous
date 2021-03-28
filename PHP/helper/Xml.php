<?php


function xmlToArray(string $xml):array
{
    libxml_disable_entity_loader(true);

    $dom = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
    $json = json_encode($dom);
    $array = json_decode($json, true);
    return $array;
}