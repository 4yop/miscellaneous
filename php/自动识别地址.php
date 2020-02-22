<?php

class address
{


    public function smart($address)
    {

        //解析结果

        $parse = [];

        $parse['name'] = '';

        $parse['mobile'] = '';

        $parse['postcode'] = '';

        $parse['idno'] = '';

        $parse['detail'] = '';

        //1. 过滤掉收货地址中的常用说明字符，排除干扰词

        $search = ['收货地址', '地址', '收货人', '收件人', '收货', '邮编', '电话', '身份证号码', '身份证号', '身份证', '：', ':', '；', ';', '，', ',', '。',];

        $replace = [' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' '];

        $address = str_replace($search, $replace, $address);//2. 连续2个或多个空格替换成一个空格

        $address = preg_replace('/ {2,}/', ' ', $address);


        //3. 去除手机号码中的短横线 如136-3333-6666 主要针对苹果手机

        $address = preg_replace('/(\d{3})-(\d{4})-(\d{4})/', '$1$2$3', $address);
        //4. 提取中国境内身份证号码
        preg_match('/\d{18}|\d{17}X/i', $address, $match);
        if ($match && $match[0]) {
            $parse['idno'] = strtoupper($match[0]);
            $address = str_replace($match[0], '', $address);
        }
        //5. 提取11位手机号码或者7位以上座机号
        preg_match('/\d{7,11}|\d{3,4}-\d{6,8}/', $address, $match);
        if ($match && $match[0]) {
            $parse['mobile'] = $match[0];
            $address = str_replace($match[0], '', $address);
        }
        //6. 提取6位邮编 邮编也可用后面解析出的省市区地址从数据库匹配出
        preg_match('/\d{6}/', $address, $match);
        if ($match && $match[0]) {
            $parse['postcode'] = $match[0];
            $address = str_replace($match[0], '', $address);
        }
        //再次把2个及其以上的空格合并成一个，并首位TRIM
        $address = trim(preg_replace('/ {2,}/', ' ', $address));
        //按照空格切分 长度长的为地址 短的为姓名 因为不是基于自然语言分析，所以采取统计学上高概率的方案
        $split_arr = explode(' ', $address);
        if (count($split_arr) > 1) {
            $parse['name'] = $split_arr[0];
            foreach ($split_arr as $value) {

                if (strlen($value) < strlen($parse['name'])) {

                    $parse['name'] = $value;

                }
            }
            $address = trim(str_replace($parse['name'], '', $address));
        }
        $parse['detail'] = $address;
        //parse['detail']详细地址可以传入另一个文件的函数，用来解析出：省，市，区，街道地址
        if ($parse['detail']) {
            $parse['detail'] = $this->getDetail($parse['detail']);
        }
        $parse = array_merge($parse, $parse['detail']);
        return $parse;
    }


    private function getDetail($address)
    {
        $add = $address;
        preg_match('/(.*?(省|自治区|北京市|天津市|上海市|重庆市))+(.*?(市|自治州|地区|区划|县))+(.*?(区|县|镇|乡|街道))/', $address, $matches);

        if (count($matches) > 1) {
            $province = $matches[1];
            $address = str_replace($province, '', $address);
        }

        preg_match('/(.*?(市|自治州|地区|区划|县))/', $address, $matches);
        if (count($matches) > 1) {
            $city = $matches[count($matches) - 2];
            $address = str_replace($city, '', $address);
        }
        preg_match('/(.*?(区|县|镇|乡|街道))/', $address, $matches);
        if (count($matches) > 1) {
            $area = $matches[count($matches) - 2];
            $address = str_replace($area, '', $address);
        }
        //将省市区替换掉 就剩下详情地址了
        $detail = str_replace($province, '', $address);
        $detail = str_replace($city, '', $detail);
        $detail = str_replace($area, '', $detail);

        return [
            'province' => isset($province) ? preg_replace("/\\d+/", '', $province) : '',
            'city' => isset($city) ? preg_replace("/\\d+/", '', $city) : '',
            'area' => isset($area) ? preg_replace("/\\d+/", '', $area) : '',
            'detail' => $detail,
        ];


    }//end getDetail


}
