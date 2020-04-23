<?php
$url = 'http://mxximg.jyet.net/images/2/2020/04/zN5irrNrmn4o5iYJ0FUAf44M4bJ06j.jpg';

$res = get_headers($url,true);
//单位 b
$size = $res['Content-Length'];



