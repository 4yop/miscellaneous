<?php

/**获取某个文件夹下的所有文件
 * @param string $path
 * @param $is_depth 是否查看子文件夹下的文件
 * @return array
 */
function getPathFile(string $path,bool $is_depth = false):array
{
    $files = scandir($path);
    $res = [];
    foreach ($files as $file)
    {
        if ($file == '.' || $file == '..')
        {
            continue;
        }

        if (is_file($path.$file))
        {
            $res[] = $path.$file;
        }elseif (is_dir($path.'/'.$file.'/') && $is_depth == true)
        {
            if ( $child_path_file =  getPathFile($path.'/'.$file.'/',$is_depth) )
            {
                $res = array_merge($res,$child_path_file);
            }


        }

    }
    return $res;
}

function mkdirs($dir, $mode = 0777):bool
{
    if (is_dir($dir) || @mkdir($dir, $mode)) return true;
    if (!mkdirs(dirname($dir), $mode)) return false;
    return @mkdir($dir, $mode);
}

$path = "C:\Users\Administrator\Desktop\\";
$files = getPathFile($path,true);
//var_dump($files);

$savePath = "D:\桌面图标备份\\";

foreach ($files as $file)
{

    $name = str_replace($path,"",$file);
    $saveFile = $savePath.$name;
    mkdirs(pathinfo($saveFile,PATHINFO_DIRNAME));
    $res = copy($file,$saveFile);
    echo "\n---------------------------\n";
    echo $file.PHP_EOL;
    echo "复制,".($res?"成功":"失败").PHP_EOL;
    echo $saveFile.PHP_EOL;
    echo "---------------------------\n";
}