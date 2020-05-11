<?php
    goto test;
?>
-----------------------------
引用变量
<?php
    $b= 1;
    $a = &$b;
    //$a = 1;
    echo $a;
    $b = 2;
    //$a = 2
    echo $a;

    unset($b);
    //取消不了
    echo $a;
?>
-----------------------------
<?php
    $a = [1,2,3];
    $a++;
    var_dump($a);
    $b = 1;

    $c = 1;
    function aa(){
        global $c;
        $c++;
        return $c;
    }
    echo $c."\n";
    echo aa()."\n";

    function func(){
        static $a = 1;
        echo $a++;
    }
    echo func();//1
    echo func();//2
?>
-----------------------------
内置函数
include require
include_once require_once

date
strtotime
mktime
time
microtime
date_default_timezone_set

ip2long
long2ip

print
printf
print_r
echo
sprintf
var_dump
var_export

serialize
unserialize

implode
explode
join
strrev
trim
ltrim
rtrim
strstr
number_format

array_keys
array_values
array_diff
array_intersect
array_merge
array_shift
array_unshift
array_pop
array_puush
sort

-----------------------------
引用返回
<?php
    function &myFunc(){
        static $b = 10;
        return $b;
    }
    echo myFunc();//10
    $a = &myFunc();
    $a = 100;
    echo myFunc();//100
?>
-----------------------------
正则
作用：分割查找匹配替换
分隔符：/  # ~
通用原子:\d \D\w \W \s \S
元字符：。 * ? ^ $ + {n} {n,m} [] () [^] | [-]
模式修正符: i m e s U x A D u

后向引用
<?php
    test:
    $str = "<b>abc</b>";
    $pattern = '/<b>.*<\/b>/';
    preg_replace($pattern,'\\ 1',$str);
    var_dump($str);
?>
贪婪模式
<?php
    $str = '<\b>abc<\/b><\b>bcd<\/b>';
    $pattern = '/<b>.* <\ /b>/';
    $pattern = '/<b>.* </b>/U';
    //preg_replace_all($pattern,'\\ 1',$str);
?>
preg_match
preg_match_all
preg_replace
preg_split
中文：
0x4e00-0x9f5(UTF-8)
0xb0-0xf7 ,0xa1-0xfe(gb2312)

<?php
    $str = "中文";
    $pattern = '/[\x{4e00}-\x{9fa5}]/u';//中
    $pattern = '/[\x{4e00}-\x{9fa5}]+/u';//中文
    preg_match($pattern,$str,$math);
    var_dump($math);
?>
<?php
    $str = '<img alt="abc" id="ab" src="image.png" />';
    $pattern = '/<img.*?src="(.*?)".*?\/?>/i';
    preg_match($pattern,$str,$match);
    var_dump($match);

    $str = '<img alt="abc" id="ab" src="http://xxx.com/image.png" />';
    $pattern = '/<img.*?src="(.*?)".*?\/?>/i';
    preg_match($pattern,$str,$match);
    var_dump($match);
?>
-----------------------------
文件
r/r+
w/w+
a/a+
x/x+
b
t
fopen
fwrite
fputs
fread
fgets
fgetc
fclose
file_get_content
file_put_ccontent
allow_url_fopen开启 fopen读取http协议（只读），ftp（读写或写）
basename
dirname
pathinfo
opendir
reddir
closedir
rewinddir
rmdir
mkdir
filesize
disk_free_spae
disk_total_space
copy
unlink
filetype
rename
ftrunate
file_exists
is_readable
is_writable
is_executable
filectime
fileatime
filemtime
fsock
ftell
fseek
rewind
<?php
    //递归输出文件
    function loopDir($dir){
        $handle = opendir($dir);

        while(false !== ($file = readfile($handle))){
            if($file != '.' && $file != '..'){
                echo $file."\n";
                if(filetype("{$dir}/$file") == 'dir'){
                    loopDir("{$dir}/$file");
                }
            }
        }
    }
?>
-----------------------------
会话控制
为什么：http是无状态协议，无法分辨用户

cookie
setcookie();
//清cookie
setcookie('xx','',time()-100);

session
session_start();
$_SESSION;
session_destory();
php.ini

session.auto_start
session.cookie_domain
session.cookie_lifetime
session.cookie_path
session.name(默认 PHPSESSID)
session.save_path
session.use_coookies
session_use.trans_sid

session.gc_probability
session.gc_divisor
session.gc_maxlifetime

session.save_handler

传递session_id
<?php
   $id =  session_id();
   $name = session_name();
   SID;
    echo "<a href='index.php?{$name}={$id}'>页面</a>"
    echo "<a href='index.php?".SID."'>页面</a>"
?>
存储
session_set_save_handler();
mysql memcahe redis等
-----------------------------
面向对象
public 类内部 都可以
proteted 类内部 子类
private 类内部 不能继承使用

魔术方法
__construct()
__destruct()
__all();
__callStatic
__get()
__set()
__isset()
__unset()
__sleep()
__wakeup()
__toString
__clone()

设计模式

工厂模式
单例模式
主数模式
适配器模式
观察者模式
策略模式
-----------------------------
网络协议
HTTP/1.1
状态码
200 成功
301 重定向
304
403
404 服务器无法找到请求资源
500 服务器错误

OSI七层模型
物理层 建立维护断开物理连接
数据链路层 建立逻辑连接，进行硬件地址寻址，差错校验等
网络层 进行逻辑地址寻址，实现不同网络之间路径选择
传输层 定义传输数据的协议端口号，以及流控和差错校验，TCP UDP，数据包一旦离开网卡即进入网络传输层
会话层 建立管理终止会话
表示层 数据的表示 安全 压缩
应用层 网络服务与最终用户的一个接口  HTTP FTP TFTP SMTP SNMP DNS TELNET HTTPS POP3 DHCP


HTTP工作特点和工作原理
特点：
基于B/S模式
通信开销小 简单快速 传输成本低
使用灵活 可使用超文本传输协议
节省传输时间
无状态

原理
客服端发送请求给服务端，创建一个TCP连接，指定端口号，默认80，连接到服务器，服务器监听浏览器请求1，一旦监听到客户端请求，分析请求类型后，服务器会向客户端返回状态信息和数据内容

常见请求头 响应头


请求方法
GET
POST
HEAD
OPTIONS
PUT
DELETE
TRACE


HTTPS工作原理
基于SSL/TLS的HTTP协议，所有HTTP数据都是在SSL/TLS协议封装之上传输的
在HTTP协议的基础上，加了SSL/TLS握手以及数据加密传输，也属于应用层协议

常见协议端口
FTP
Telent
SMTP
POP3
HTTP
DNS
-----------------------------

