<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
//1233.删除子文件夹
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function removeSubfolders($folder) {
        sort($folder);
        $end = count($folder) - 1;
        for($i = 0;$i < $end;$i++){
            $start = strpos($folder[$i+1],$folder[$i].'/');
            if($start !== false){
                if($start === 0){
                    $folder[$i+1] = $folder[$i];
                }
                unset($folder[$i]);
            }
        }
        return $folder;
    }
}

$solution = new Solution();//bacdfeg
$folders =[
    ["/a","/a/b","/c/d","/c/d/e","/c/f"],
    ["/a","/a/b/c","/a/b/d"],
    ["/a/b/c","/a/b/d","/a/b/ca"],
];
foreach ($folders as $folder) {
    $res = $solution->removeSubfolders($folder);
    var_dump($res);
}
