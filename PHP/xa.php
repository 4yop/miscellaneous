<?php
/**
 * 192.168.10.91 3306 root rootroot test1 test
 * 192.168.10.92 3306 root rootroot test2 test
 *
 *
 */



try
{
    $db1 = new mysqli("192.168.10.91","root","rootroot","test1",3306);
    $db2 = new mysqli("192.168.10.92","root","rootroot","test2",3306);


//为XA事务指定一个id，xid 必须是一个唯一值。
    $xid = uniqid("");
    $time = time();

//两个库指定同一个事务id，表明这两个库的操作处于同一事务中
    $db1->query("XA START '$xid'");//准备事务1
    $db2->query("XA START '$xid'");//准备事务2


    $res1 = $db1->query("update `test` set `name`='qqq',update_time= {$time} where id = 1 AND create_time=1648370803");

    mysqli_affected_rows($db1);

    if (!$res1 || mysqli_affected_rows($db1) < 1)
    {
        throw new Exception("db1 query update 失败,".mysqli_error($db1).__LINE__);
    }

    $res1 = $db1->query("insert into `test`(`name`,`create_time`,`update_time`) values('test1',$time,$time)");
    if (!$res1 || mysqli_affected_rows($db1) < 1)
    {
        throw new Exception("db1 query insert 失败,".mysqli_error($db1).__LINE__);
    }
    $res2 = $db2->query("insert into `test`(`name`,`create_time`,`update_time`) values('test2',$time,$time)");
    if (!$res2 || mysqli_affected_rows($db2) < 1)
    {
        throw new Exception("db2 query insert 失败,".mysqli_error($db2).__LINE__);
    }

    //阶段1：$dbtest1提交准备就绪
    $db1->query("XA END '$xid'");
    $db1->query("XA PREPARE '$xid'");
    //阶段1：$dbtest2提交准备就绪
    $db2->query("XA END '$xid'");
    $db2->query("XA PREPARE '$xid'");

    //阶段2：提交两个库
    $db1->query("XA COMMIT '$xid'");
    $db2->query("XA COMMIT '$xid'");

}
catch (Exception $e)
{
    //阶段2：回滚
    $db1->query("XA ROLLBACK '$xid'");
    $db2->query("XA ROLLBACK '$xid'");
    echo "异常:".$e->getMessage()."\n";
    exit;
}

echo "成功\n";
$db1->close();
$db2->close();