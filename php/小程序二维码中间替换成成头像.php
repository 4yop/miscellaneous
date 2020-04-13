<?php
/**
 * 步骤:
 * 1.获得微信返回的二维码图片数据流
 * 2.把用户头像变成圆形，覆盖到小程序中间的空白部分
 * 3.把二维码与圆形头像结合
 * 3.返回客户端，或者输出显示
 */

$appid       = '你的APPID';//appid
$appsecret   = '你的APPSECRET';//app secret
$send        = array('scene'=>123, 'path' =>'pages/question/question', 'width'=>'100');//传给微信的参数
$avatarUrl   = 'https://wx.qlogo.cn/mmopen/vi_32/1gpRvhLTcSxV93niaJicKFSS54vqaLIl46XLsUBpbzl2psIA5jpuuibGPft8EFicIvjCupQlshXjias7Gc7VLBiag4mw/132';//用户头像url

//请求微信，获取小程序二维码
//$resWxQrCode = getWxQrcode($send,$appid,$appsecret);
$resWxQrCode = "http://mxximg.jyet.net/images/2020-04-10/280b46af13edb9bd55c810babeb2a24f.png";
//用户头像图片变圆形
$avatar = file_get_contents($avatarUrl);
$resWxQrCode = file_get_contents($resWxQrCode);
$logo   = yuanImg($avatar);//返回的是图片数据流
//二维码与头像结合
$sharePic = qrcodeWithLogo($resWxQrCode,$logo);
var_dump($sharePic);
//这里为了看效果，直接输出图片了
echo "<image src='data:image/png;base64,".base64_encode($sharePic)."'>";



/**
 * 在二维码的中间区域镶嵌图片
 * @param $QR 二维码数据流。比如file_get_contents(imageurl)返回的东东,或者微信给返回的东东
 * @param $logo 中间显示图片的数据流。比如file_get_contents(imageurl)返回的东东
 * @return  返回图片数据流
 */
function qrcodeWithLogo($QR,$logo){
    $QR   = imagecreatefromstring ($QR);
    $logo = imagecreatefromstring ($logo);
    $QR_width    = imagesx ( $QR );//二维码图片宽度
    $QR_height   = imagesy ( $QR );//二维码图片高度
    $logo_width  = imagesx ( $logo );//logo图片宽度
    $logo_height = imagesy ( $logo );//logo图片高度
    $logo_qr_width  = $QR_width / 2.2;//组合之后logo的宽度(占二维码的1/2.2)
    $scale  = $logo_width / $logo_qr_width;//logo的宽度缩放比(本身宽度/组合后的宽度)
    $logo_qr_height = $logo_height / $scale;//组合之后logo的高度
    $from_width = ($QR_width - $logo_qr_width) / 2;//组合之后logo左上角所在坐标点
    /**
     * 重新组合图片并调整大小
     * imagecopyresampled() 将一幅图像(源图象)中的一块正方形区域拷贝到另一个图像中
     */
    imagecopyresampled ( $QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height );
    /**
     * 如果想要直接输出图片，应该先设header。header("Content-Type: image/png; charset=utf-8");
     * 并且去掉缓存区函数
     */
    //获取输出缓存，否则imagepng会把图片输出到浏览器
    ob_start();
    imagepng ( $QR );
    imagedestroy($QR);
    imagedestroy($logo);
    $contents =  ob_get_contents();
    ob_end_clean();
    return $contents;
}
/**
 * 剪切图片为圆形
 * @param  $picture 图片数据流 比如file_get_contents(imageurl)返回的东东
 * @return 图片数据流
 */
function yuanImg($picture) {
    $src_img = imagecreatefromstring($picture);
    $w   = imagesx($src_img);
    $h   = imagesy($src_img);
    $w   = min($w, $h);
    $h   = $w;
    $img = imagecreatetruecolor($w, $h);
    //这一句一定要有
    imagesavealpha($img, true);
    //拾取一个完全透明的颜色,最后一个参数127为全透明
    $bg = imagecolorallocatealpha($img, 255, 255, 255, 127);
    imagefill($img, 0, 0, $bg);
    $r   = $w / 2; //圆半径
    $y_x = $r; //圆心X坐标
    $y_y = $r; //圆心Y坐标
    for ($x = 0; $x < $w; $x++) {
        for ($y = 0; $y < $h; $y++) {
            $rgbColor = imagecolorat($src_img, $x, $y);
            if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                imagesetpixel($img, $x, $y, $rgbColor);
            }
        }
    }
    /**
     * 如果想要直接输出图片，应该先设header。header("Content-Type: image/png; charset=utf-8");
     * 并且去掉缓存区函数
     */
    //获取输出缓存，否则imagepng会把图片输出到浏览器
    ob_start();
    imagepng ( $img );
    imagedestroy($img);
    $contents =  ob_get_contents();
    ob_end_clean();
    return $contents;
}
?>
