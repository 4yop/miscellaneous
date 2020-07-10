<?php


    error_reporting(1);
    define('IN_MOBILE', true);


    require dirname(__FILE__) . '/../../framework/bootstrap.inc.php';

    require_once IA_ROOT . '/addons/qidian_sqlife/framework/common/config.path.php';
    require_once QIDIANSQLIFE_COMMON . 'functions.php';


    require_once IA_ROOT . '/framework/library/phpexcel/PHPExcel.php';

    $get_member_commiss = function ($last_id){
        $sql = "SELECT * FROM ".tablename('qidian_sqlife_member_commiss')." WHERE `id` > {$last_id} ORDER BY `id` ASC ";
        $data = pdo_fetch($sql);
        return $data;
    };


    $dir = dirname(__FILE__);
    $file_name = "{$dir}/commiss.xlsx";

    $objPHPExcel = PHPExcel_IOFactory::load($file_name);
    //$objPHPExcel = new PHPExcel(); //实例化一个PHPExcel()对象
    $objSheet = $objPHPExcel->getActiveSheet(); //选取当前的sheet对象
    $objSheet->setTitle('helen'); //对当前sheet对象命名

    $insert_excel = function($objPHPExcel,$res){
        $rowCount = $objPHPExcel->getActiveSheet()->getHighestRow();
        //echo $rowCount."\n";
        $row = $rowCount + 1;
        //id	用户	可提现金额	提现中金额	已提现金额	银行名称	卡号	持卡人姓名	计算总的已结算	计算总的待结算	计算总的已提现 计算总的已提中
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $res['id']);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $res['member']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $res['money']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $res['dongmoney']);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $res['getmoney']);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $res['bankname']);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $res['bankaccount']);
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $res['bankusername']);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $res['money1']);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $res['money2']);
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $res['money3']);
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, $res['money4']);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007'); //设定写入excel的类型
        $dir = dirname(__FILE__);
        $file_name = "{$dir}/commiss.xlsx";
        $objWriter->save($file_name); //保存文件

        $rowCount = $objPHPExcel->getActiveSheet()->getHighestRow() ;
        echo "{$res['member']}--第{$rowCount}行\n";

    };

    $get_data = function($data){
        $res = [];

        $member = pdo_get('qidian_sqlife_member',['member_id'=>$data['member_id']]);


        //已结算
        $sql = "SELECT SUM(`money`) AS `money` FROM ".tablename("qidian_sqlife_member_commiss_order")." WHERE `state` = 1 AND `member_id` = {$data['member_id']} ";
        $money1 = pdo_fetch($sql);
        //待结算
        $sql = "SELECT SUM(`money`) AS `money` FROM ".tablename("qidian_sqlife_member_commiss_order")." WHERE `state` = 0  AND `member_id` = {$data['member_id']} ";
        $money2 = pdo_fetch($sql);


        //提现成功
        $sql = "SELECT SUM(`money`) AS `money` FROM ".tablename("qidian_sqlife_member_tixian_order")." WHERE `state` = 1  AND `member_id` = {$data['member_id']} ";
        $money3 = pdo_fetch($sql);

        //提现中
        $sql = "SELECT SUM(`money`) AS `money` FROM ".tablename("qidian_sqlife_member_tixian_order")." WHERE `state` = 0  AND `member_id` = {$data['member_id']} ";
        $money4 = pdo_fetch($sql);

        $res['id'] = $data['id'];
        $res['member'] = !empty($member) ? "[{$member['member_id']}]{$member['username']}" : '';
        $res['money'] = $data['money'];
        $res['dongmoney'] = $data['dongmoney'];
        $res['getmoney'] = $data['getmoney'];
        $res['bankname'] = $data['bankname'];
        $res['bankaccount'] = $data['bankaccount'];
        $res['bankusername'] = $data['bankusername'];
        $res['money1'] = $money1['money'];
        $res['money2'] = $money2['money'];
        $res['money3'] = $money3['money'];
        $res['money4'] = $money4['money'];

        return $res;
    };


    $last_id = 0;
    $data = $get_member_commiss($last_id);
    while(!empty($data)){
        $last_id = $data['id'];
        $data = $get_member_commiss($last_id);
        $res = $get_data($data);
        $insert_excel($objPHPExcel,$res);
    }
    exit;











