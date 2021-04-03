<?php

    /** 获取某个目录下的所有文件
     * @param string $path
     * @return array
     */
    function getPathFile(string $path):array
    {
        $files = scandir($path);
        $res = [];
        foreach ($files as $file)
        {
            if (!is_file($path.$file))
            {
                continue;
            }
            $res[] = $file;
        }
        return $res;
    }