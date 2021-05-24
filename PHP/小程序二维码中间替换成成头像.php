<?php
    //演示的用户头像
    $avatarUrl   = 'https://wx.qlogo.cn/mmopen/vi_32/1gpRvhLTcSxV93niaJicKFSS54vqaLIl46XLsUBpbzl2psIA5jpuuibGPft8EFicIvjCupQlshXjias7Gc7VLBiag4mw/132';


    //演示的 小程序码
    $resWxQrCode = 'https://res.wx.qq.com/wxdoc/dist/assets/img/code1.ec7b95c0.jpg';


    //用户头像图片变圆形
    $avatar = file_get_contents($avatarUrl);//头像的图片流
    $resWxQrCode = file_get_contents($resWxQrCode);//小程序吗码的图片流


    //头像变圆形
    $logo   = roundImg($avatar);//返回的是图片数据流

    //二维码与头像结合
    $sharePic = qrocdeCenterLogo($resWxQrCode,$logo);//返回的是图片数据流
    //var_dump($sharePic);

    //看效果
    echo "<img src='data:image/png;base64,".base64_encode($sharePic)."'>";

    //保存为图片
    $save_name = md5(uniqid().uniqid().time()).".png";
    touch($save_name);
    file_put_contents($save_name,$sharePic);


    /**
     * 在二维码的中间区域加图片
     * @param $QR 二维码数据流
     * @param $logo 中间显示图片的数据流
     * @return  返回图片数据流
     */
    function qrocdeCenterLogo($QR,$logo){
        $QR   = imagecreatefromstring ($QR);
        $logo = imagecreatefromstring ($logo);
        $QR_width    = imagesx ( $QR );
        $QR_height   = imagesy ( $QR );
        $logo_width  = imagesx ( $logo );
        $logo_height = imagesy ( $logo );
        $logo_qr_width  = $QR_width / 2.2;//组合之后logo的宽度(占二维码的1/2.2)
        $scale  = $logo_width / $logo_qr_width;
        $logo_qr_height = $logo_height / $scale;
        $from_width = ($QR_width - $logo_qr_width) / 2;

        imagecopyresampled ( $QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height );
        /**
         * 想要直接输出图片，应该先设header。header("Content-Type: image/png; charset=utf-8");
         * 并去掉缓存区函数
         */
        ob_start();
        imagepng ( $QR );
        imagedestroy($QR);
        imagedestroy($logo);
        $contents =  ob_get_contents();
        ob_end_clean();
        return $contents;
    }//end qrocdeCenterLogo();
    /**
     * 剪切图片为圆形
     * @param  $picture 图片数据流
     * @return 图片数据流
     */
    function roundImg($picture)
    {
        $src_img = imagecreatefromstring($picture);
        $w   = imagesx($src_img);
        $h   = imagesy($src_img);
        $w   = min($w, $h);
        $h   = $w;
        $img = imagecreatetruecolor($w, $h);

        imagesavealpha($img, true);

        $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
        imagefill($img, 0, 0, $bg);
        $r   = $w / 2; //圆半径
        for ($x = 0; $x < $w; $x++)
        {
            for ($y = 0; $y < $h; $y++)
            {
                $rgbColor = imagecolorat($src_img, $x, $y);
                if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                    imagesetpixel($img, $x, $y, $rgbColor);
                }
            }
        }
        /**
         * 想要直接输出图片，应该先设header。header("Content-Type: image/png; charset=utf-8");
         * 并去掉缓存区函数
         */
        ob_start();
        imagepng ( $img );
        imagedestroy($img);
        $contents =  ob_get_contents();
        ob_end_clean();
        return $contents;
    }//end roundImg()

?>
