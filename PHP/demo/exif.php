<?php

$img = 'C:\Users\Administrator\Pictures\微信图片_20210709155801.jpg';

$exif = exif_read_data($img, 0,true);



var_dump( array (

    '文件名' => $exif['FileName'],

    '器材品牌' => $exif['Make'],

    '器材' => $exif['Model'],

    '快门' => $exif['ExposureTime'],

    '光圈' => $exif['FNumber'],

    '焦距' => $exif['FocalLength'],

    '感光度' => $exif['ISOSpeedRatings']

)
);

var_dump($exif['GPS']);
