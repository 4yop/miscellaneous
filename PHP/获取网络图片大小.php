<?php
    //图片链接
    $url = 'https://pics6.baidu.com/feed/562c11dfa9ec8a13c51881e3fed10987a1ecc08a.jpeg?token=243dcd3a376777cb9552ec66de9c74b2';

    $res = get_headers($url,true);

    //单位 b
    $size = $res['Content-Length'];

    echo "图片大小:{$size}b";

