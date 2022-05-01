<?php

function getFilesByDir(string $dir):array
{
    $res = [];
    $files = scandir($dir);
    foreach ($files as $file)
    {
        if ($file == '.' || $file == '..')
        {
            continue;
        }
        $name = $dir."/".$file;
        if (is_file($name))
        {
            $res[] = $name;
        }else
        {
            $res = array_merge($res,getFilesByDir($name));
        }
    }
    return $res;
}

/**直接遍历 ，或者二分查找
 * @param int[] $arr
 * @param int $val
 * @return int
 */
function getIndexByVal($arr = [1,2,3,4,5],$val = 3):int
{
   foreach ($arr as $k=>$v)
   {
        if ($v >= $val)
        {
            return $k;
        }
   }

   return $k+1;
}