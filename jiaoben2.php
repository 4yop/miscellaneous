<?php

$file = "/etc/sysconfig/network-scripts/ifcfg-enp0s3";
$file = "ifcfg0-ens3";

$num = "2";

$content = file_get_contents($file);

$content_arr = explode("\n",$content);


$parame = [];
foreach ($content_arr as $item)
{
    [$key,$value] = explode("=",$item);
    $parame[$key] = $value;
}

print_r($parame);

$parame["ONBOOT"] = '"yes"'.PHP_EOL;
$parame["BOOTPROTO"] = '"static"'.PHP_EOL;
$parame["IPADDR"] = '"192.168.10.9'.$num.'"'.PHP_EOL;


$new_content = "";
foreach ($parame as $k => $v)
{
    $new_content .= "{$k}={$v}";
}

echo $new_content;
//file_put_contents();
file_put_contents("ifcfg-enp0s3.new",$new_content);

$cmd = "systemctl restart network";

exec($cmd,$output);
print_r($output);