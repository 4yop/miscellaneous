<?php

/**将各种截然不同的函数接口封装成统一的API。
PHP中的数据库操作有MySQL,MySQLi,PDO三种，可以用适配器模式统一成一致，使不同的数据库操作，统一成一样的API。类似的场景还有cache适配器，可以将memcache,redis,file,apc等不同的缓存函数，统一成一致。
首先定义一个接口(有几个方法，以及相应的参数)。然后，有几种不同的情况，就写几个类实现该接口。将完成相似功能的函数，统一成一致的方法。
 * Interface Db
 */
interface Db
{
    public function conn($host,$username,$pass,$dbname,$port);

    public function query($sql);
}


class Mysql implements Db
{
    protected $conn = null;
    public function conn($host, $username, $pass, $dbname,$port)
    {
        // TODO: Implement conn() method.
        $this->conn = mysqli_connect($host,$username,$pass,$dbname,$port);
    }

    public function query($sql)
    {
        // TODO: Implement query() method.
        return mysqli_query($this->conn,$sql);
    }
}

class PDO implements Db
{
    protected $conn = null;
    public function conn($host, $username, $pass, $dbname, $port)
    {
        // TODO: Implement conn() method.
        $this->conn = new \PDO("mysql:host={$host};dbname={$dbname}",$username,$pass);
    }

    public function query($sql)
    {
        // TODO: Implement query() method.
        return $this->conn->query($sql);
    }
}


