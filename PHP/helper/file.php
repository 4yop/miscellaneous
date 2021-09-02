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


    $a = getPathFile("D:\cmder",true);

    print_r($a);


function file_size_format($filesize)
{
    $filesize = intval($filesize);
    $res = '';
    if ($filesize >= 1024 *1024 *1024) {
        //转成GB
        $res = round($filesize*100 / (1024 *1024 *1024) ) / 100 . ' GB';
    } elseif ($filesize >= 1024 * 1024) {
        //转成MB
        $res = round($filesize*100 / (1024 * 1024) ) / 100 . ' MB';
    } elseif ($filesize >= 1024) {
        //转成KB
        $res = round($filesize*100 / 1024 ) / 100 . ' KB';
    } else {
        //不转换直接输出
        $res = $filesize . ' B';
    }
    return $res;
}

    $res = file_size_format(filesize("a.jpg"));