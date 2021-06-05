<?php

class Parse
{
    //解析收货地址
    public function getAddressInfo(string $address):array
    {
        //解析结果
        $result = [
            'name'     => '',//名字
            'mobile'   => '',//手机
            'postcode' => '',//邮编
            'idno'     => '',//身份证号
            'detail'   => [],//地址
            'adcode'   => '',//区号
        ];


        //1. 过滤掉收货地址中的常用说明字符，排除干扰词
        $search = ['收货地址', '地址', '收货人', '收件人', '收货', '邮编', '电话', '身份证号码', '身份证号', '身份证', '：', ':', '；', ';', '，', ',', '。',];

        $replace = [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '];

        $address = str_replace($search, $replace, $address);//2. 连续2个或多个空格替换成一个空格

        $address = preg_replace('/ {2,}/', ' ', $address);


        //3. 去除手机号码中的短横线 如136-3333-6666 主要针对苹果手机
        $address = preg_replace('/(\d{3})-(\d{4})-(\d{4})/', '$1$2$3', $address);
        //4. 提取中国境内身份证号码
        preg_match('/\d{18}|\d{17}X/i', $address, $match);
        if ($match && $match[0])
        {
            $result['idno'] = strtoupper($match[0]);
            $address = str_replace($match[0], '', $address);
        }
        //5. 提取11位手机号码或者7位以上座机号
        preg_match('/\d{7,11}|\d{3,4}-\d{6,8}/', $address, $match);
        if ($match && $match[0])
        {
            $result['mobile'] = $match[0];
            $address = str_replace($match[0], '', $address);
        }
        //6. 提取6位邮编 邮编也可用后面解析出的省市区地址从数据库匹配出
        preg_match('/\d{6}/', $address, $match);
        if ($match && $match[0]) {
            $result['postcode'] = $match[0];
            $address = str_replace($match[0], '', $address);
        }
        //再次把2个及其以上的空格合并成一个，并首位TRIM
        $address = trim(preg_replace('/ {2,}/', ' ', $address));
        //按照空格切分 长度长的为地址 短的为姓名 因为不是基于自然语言分析，所以采取统计学上高概率的方案
        $split_arr = explode(' ', $address);
        if (count($split_arr) > 1)
        {
            $result['name'] = $split_arr[0];
            foreach ($split_arr as $value)
            {

                if (strlen($value) < strlen($result['name']))
                {

                    $result['name'] = $value;

                }
            }
            $address = trim(str_replace($result['name'], '', $address));
        }
        $result['detail'] = $address;
        //parse['detail']详细地址可以传入另一个文件的函数，用来解析出：省，市，区，街道地址
        if ($result['detail'])
        {
            $result['detail'] = $this->getDetailFromMap($result['detail']);
        }
        $result = array_merge($result, $result['detail']);
        return $result;
    }


    //根据地图来查
    public function getDetailFromMap($address):array
    {

        $tx_map_key = "腾讯地图key";
        $url = "https://apis.map.qq.com/ws/geocoder/v1/?address={$address}&key={$tx_map_key}";

        $res = file_get_contents($url);
        $res = json_decode($res,true);

        if($res && $res['status'] == 0)
        {
            $address_components = $res['result']['address_components'];
            $province = $address_components['province'];
            $city = $address_components['city'];
            $area = $address_components['district'];



            //将省市区替换掉 就剩下详情地址了
            $detail = str_replace($province, '', $address);
            $detail = str_replace($city, '', $detail);
            $detail = str_replace($area, '', $detail);

            return [
                'province' => $province,
                'city' => $city,
                'area' => $area,
                'detail' => $detail,
                'adcode' => $res['result']['ad_info']['adcode'],
            ];

        }
        return [
            'province' => '',
            'city' => '',
            'area' => '',
            'detail' => $address,
            'adcode' => '',
        ];

    }

}







$a = new Parse();

$string = "584086 小明,北京天安门  13823876888  ";
$r = $a->getAddressInfo($string);
var_dump($r);