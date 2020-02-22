<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/7
 * Time: 10:19
 */




    //
    /**获取手机归属第
     * @param $mobile
     * @return bool
     */
    function get_QCellCore($mobile){
        $url = "http://mobsec-dianhua.baidu.com/dianhua_api/open/location?tel={$mobile}";
        $res = file_get_contents($url);
        $res = json_decode($res,true);
        if(!$res  || !$res['response'] || !isset($res['response'][$mobile]['detail']) ){
            return false;
        }else{
            $re = $res['response'][$mobile]['detail'];
            $city = $re['area'][0]['city'];
            $pro  = $re['province'];
            $op   = $re['operator'];

            return insert($mobile,$city,$pro,$op);
        }
    }

    /**
     * @param $mobile 手机号
     * @param $city 城市
     * @param $pro 省
     * @param $op 运营商
     */
    function insert($mobile,$city,$pro,$op){

        $idfile = 'id.txt';
        $id = file_get_contents($idfile);
        $id = $id ? intval($id) : 1;
        file_put_contents($idfile,($id+1));
        $log = "{$id},{$mobile},{$city},{$pro},{$op}\n";
        $filename = 'data.txt';
        $fh = fopen($filename, "a");
        $res = fwrite($fh, $log);
        fclose($fh);
        return $res;
    }
    $mobile = "13058377106";
    $res = get_QCellCore($mobile);

