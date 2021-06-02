<?php

/** xml转数组
 * @param string $xml
 * @return array
 */
function xmlToArray(string $xml):array
{
    libxml_disable_entity_loader(true);
    $dom = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
    $json = json_encode($dom);
    $array = json_decode($json, true);
    return $array;
}

/** 数组转xml
 * @param array $arr
 * @return string
 */
function arrayToXml(array $arr):string
{
    $xml = "<root>";
    foreach ($arr as $key => $val) {

        if (is_array($val)) {

            $xml .= "<" . $key . ">" . arrayToXml($val) . "";

        } else {

            $xml .= "<" . $key . ">" . $val . "";

        }

    }
    $xml .= "</root>";
    return $xml;
}