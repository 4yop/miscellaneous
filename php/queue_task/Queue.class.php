<?php

require_once 'db.php';
//队列入库 取
class Queue{

    public $conn = NULL;
    public function __construct($conn)
    {
        if($this->conn == NULL){
            $this->conn = $conn;
        }
    }

    /**添加需要执行的任务入库
     * @param $taskphp 要执行的php文件
     * @param $param 参数
     * @return bool
     */
    public function add($taskphp,$param)
    {

        //$taskphp = $this->conn->quote($taskphp);
        $sql = "INSERT INTO `queue` (`taskphp`,`param`) VALUE ('{$taskphp}','{$param}')";
        $re = $this->conn->exec($sql);
        if($re){
            return $re;
        }else{
            return false;
        }
    }

    /**获取任务列表
     * @param int $limit 一次取几条
     * @return mixed
     */
    public function getQueueTask($limit = 1000)
    {
        $limit = (int) $limit;
        $sql = "SELECT * FROM `queue` WHERE `status` = 0 LIMIT {$limit} ORDER BY  `id` ASC ";
        $re = $this->conn->query($sql);
        return $re;
    }

    public function updateTaskById($id)
    {
        $id = (int) $id;
        $mtime = time();
        $sql = "UPDATE `queue` SET `status` = 1 ,`mtime` = {$mtime} WHERE `id` = {$id} ";
        return $this->conn->execute($sql);
    }

    //数组转文字
    public static function a2s($arr)
    {
        $str = '';
        foreach($arr as $k => $v)
        {
            if(is_array($v))
            {
                foreach ($v as $key => $value)
                {
                    $str .= urlencode($key)."[]=".urlencode($value).'&';
                }
            }
            else
            {
                $str .= urlencode($k)."=".urlencode($v);
            }
        }
        return $str;
    }

    //文字转数组
    public static function s2a($str)
    {
        $arr = [];
        parse_str($str,$arr);
        return $arr;
    }
}

