<?php
ini_set("session.save_handler", "redis");
ini_set("session.save_path", "tcp://127.0.0.1:6379?auth=");
//换行符
$row = substr(PHP_SAPI_NAME(), 0, 3) !== 'cli' ? "<br>" : PHP_EOF;
//var_dump($_SERVER);
session_start();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!isset($_POST['user']) || empty($_POST['user']))
    {
        exit("user 为空<a href='/'>回</a>");
    }



    $_SESSION['user'] = $_POST['user'];

    echo "登录成功,<a href='/'>查看</a>";

    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?= $_SERVER['SERVER_NAME'] ?>
<?= $row ?>
<?= $_SERVER['HTTP_HOST'] ?>
<?= $row ?>


<?= __FILE__; ?>
<?= $row ?>
<?= PHP_SAPI_NAME() ?>
<?= $row ?>

当前用户:
<?php

var_dump($_SESSION['user']);
?>

<form method="post">
    <input type="text" name="user" required value="" placeholder="请输入用户">
    <input type="submit" value="提交">
</form>


</body>
</html>
