<?php


    exec("set PATH",$output);


    //var_dump($output[0]);
   // echo $output[0];

    //D:\phpstudy_pro\Extensions\php\php5.6.9nts;

    //D:\phpstudy_pro\Extensions\php\php7.3.4nts;


    $path = str_replace("Path=",'',$output[0]);

    $pathArr = explode(';',$path);

    foreach ($pathArr as $k=>$v)
    {
        if ( strpos($v,"D:\\phpstudy_pro\\Extensions\\php\\") !== false) {
            //echo $v."\n";
            unset($pathArr[$k]);
            //$pathArr[$k] = '';
        }
    }
   // $php = "D:\phpstudy_pro\Extensions\php\php7.3.4nts";
    $php = "D:\phpstudy_pro\Extensions\php\php5.6.9nts";
    array_push($pathArr,$php);

    $content =  implode(";",$pathArr);



    $env = implode("\n",$output);

    //echo $env;

    //echo "set PATH = $output[0]";
    exec("set Path = $content",$output);
    exec("set PATH = $content",$output);

    print_r($output);