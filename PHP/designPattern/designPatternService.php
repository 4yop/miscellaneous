<?php
namespace designPattern;

class designPatternService
{
    public static function createPractice()
    {
        $directory = PHP_PATH."/designPattern/";
        $files = scandir($directory);

        $practiceModulePath = ROOT_PATH."/dailyPractice/designPattern/";
        $res = mkdir($practiceModulePath,0777);
        if (!$res) {
            echo "创建{$practiceModulePath}失败\n";
        }
        $save_path = $practiceModulePath."DAY_".date('Y_m_d')."/";
        $res = mkdir($save_path,0777);
        if (!$res) {
            echo "创建{$save_path}失败\n";
        }

        foreach ($files as $file)
        {
            if (is_dir($directory.$file) && !in_array($file,['.','..']))
            {
                $res = mkdir($save_path.$file,0777);
                if ($res) {
                    echo "创建{$save_path}{$file}成功\n";
                }else{
                    echo "创建{$save_path}{$file}失败\n";
                }
            }
        }
        return true;
    }

    public static function testPractice()
    {
        $directory = PHP_PATH."/designPattern/";
        $files = scandir($directory);

        $practiceModulePath = ROOT_PATH."/dailyPractice/designPattern/";


        $save_path = $practiceModulePath."DAY_".date('Y_m_d')."/";

        foreach ($files as $file)
        {
            if (is_dir($directory.$file) && !in_array($file,['.','..']))
            {
                if (!file_exists($save_path.$file."/Test.php")) {
                    echo "{$file} 没做 \n";
                    continue;
                }
                echo "\n-------------------\n";
                $class = '\\dailyPractice\\designPattern\\DAY_'.date('Y_m_d').'\\'.$file.'\\Test';


                error_reporting(E_ALL);
                new $class();
                echo "\n-------------------\n";
            }
        }
    }

}