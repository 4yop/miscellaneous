高并发和大流量
架构概念:
高并发:并发访问,某个时间点，有多个访问同时到来。
一个系统日PV在千万级以上，可能是高并发系统。不走技术路线的就全靠堆机器。
QPS:
吞吐量:
响应时间:
PV:
UV:
带宽:
日网站带宽:
压力测试:

ab的使用
ab -c 100(并发数) -n 500(总请求数) 网站
注意:测试机器与被测试机器分开;不要对线上服务做压力测试；观察测和被测机器的CPU，内存，网络等都不能超高最高限度的75%

QPS<=50,不优化
QPS<=100,方案:数据库缓存，数据库的负载均衡
QPS<=800,CDN加速，负载均衡
QPS<=1000,静态HTML缓存
QPS<=200,业务分离，分布式存储

流量优化
防盗链处理
前端优化:减少HTTP请求;添加异步请求;启用浏览器缓存和文件压缩;CDN加速;建立独立的图片服务器;
服务端优化:页面静态化;并发处理;队列处理;
数据库优化:数据库缓存;分库分表,分区操作;读写分离;负载均衡;
web服务器优化:负载均衡;
---------------------------------------
web防盗链
盗链概念
防盗链概念
nginx:
ngx_http_referer_module 阻挡来源非法的域名请求
valid_referers,全局变量$invalid_referer
location ~ .*\.(gif|jpg|png|flv|swf|rar|zip)$
{
    valid_referers none blocked imooc.com *.imooc.com;
    if ($invalid_referer) {
        return 403;
    }
}

#目录防盗链 location /images/
location ~* \.(gif|jpg|png|jpeg)$
{
    expires     30d;
    valid_referers none blocked  test.com baidu.com *.baidu.com;
    if ($invalid_referer)
    {
    #rewrite ^/ http://ww4.sinaimg.cn/bmiddle/051bbed1gw1egjc4xl7srj20cm08aaa6.jpg;
    return 404;
    }
}
加密签名
HttpAccessKeyModule
accesskey on|off 模块开关
accesskey_hashmethod md5| sha-1 签名加密方式
accesskey_arg GET参数名称
accesskey_signature加密规则
返回 302错误
location ~ .*\.(gif|jpg|png|flv|swf|rar|zip)$
{
    accesskey on;
    accesskey_hashmethod md5
    accesskey_arg sign;
    accesskey_signature "mypass$remote_addr";
}
<?php
    echo $_SERVER['REMOTE_ADDR'];
    $sign = md5("mypass{$_SERVER['REMOTE_ADDR']}");
    echo "<img src='./test.png?sign={$sign}'>";
?>
---------------------------------------
减少HTTP请求
HTTP开销:域名解析--TCP连接--发送请求--等待--下载资源--解析时间
DNS缓存
Keep-Alive

图片地图:用html标签<map></map>来减少图片请求，一图关联多个url
CSS Sprites(css精灵):
合并脚本和样式表适:把多个脚本合并成一个脚本，把多个样式合并成一个样式表
base64编码图片减少请求
---------------------------------------
浏览器缓存和数据压缩
HTTP缓存机制
1.200 from cache:直接从本地缓存获取响应，最快最省流量，没向服务器发送请求
header设置
Pragma:no-cache(禁用本地缓存)，每次请求服务器
Expires:Thu,31 Dec 2037 23:55:55 GMT (到这时间浏览器缓存过期)，无需发送请求
Cache-Control:解决Expires本地时和服务器时不一致，告知浏览器的缓存是间隔而不是时刻，no-store(禁止浏览器缓存)，no-cache（不允许直接用本地缓存，先发请求和服务器协商），
max-age=delta-seconds:告知浏览器该响应本地缓存最长有效期限（秒）
优先级
Pragma>Cache-Control->Expires


2.304 Not Modified:协商缓存，浏览器在本地没有命中的情况下，请求头发送校验数据到服务端,如果服务端没有改变浏览器本地缓存响应，返回304
快速，发送的数据少，只返回一些基本的响应头信息，数据量很小，不发送实际响应体
header设置
Last-Modified:通知浏览器资源最后修改时间
If-Modified-Since：Thu,31 Dec 2037 23:55:55 GMT，获取最后修改时间，将该信息通过If-Modified-Since提交到服务器检查，如果没修改，返回304
Etag:文件指纹标识符，如文件内容改，指纹会改变
If-None-Match：本地缓存失效，带该值去请求服务器，服务器判断该资源是否改变，如未改，用本地缓存，返回304

3.200 OK:以上两种缓存都失败，服务器返回完整响应，没有用到缓存，相对最慢


适合缓存：不变的图（logo，图标等）;js，css静态文件;可下载的内容媒体文件;
协商缓存建议:html文件;经常替换的图;经常改的js，css;

不建议缓存的：用户隐私等敏感数据，经常改变的api数据接口

<?php
    $since = $_SERVER['HTTP_IF_MODIFIED_SINCE'];
    $lifetime=10;
    if(strtotime($since)+$lifetime>time()){
        header('HTTP/1.1 304 NOT Modified');
        exit;
    }
    //Last-Modified : 通知浏览器资源的最后修改时间
    //If-Modified-Since : 得到资源的最后修改时间后，会将这个信息通过If-Modified-Since提交到服务器做检查，如果没有修改返回304状态码
    header('Last-Modified:'.gmdate('D d M Y H:i:s',time()).'GMT');
    echo time()."<br>";
?>


NGINX配置缓存策略
本地缓存配置
add_header:加状态码2xx和3xx的响应头信息
            add_header name value [always];
            可设置Pragma/Expires/Cache-Control，可以继承
            expires time(过期时长)
            Cache-Control:no-cache;

            当为正或者0时，就表示cacha-control:max-age=指定时间;
协商缓存相关配置
Etag:指定签名吗
etag:on | off

前端代码和资源压缩
让资源文件更小，加快文件在网络中的传输，让网页更快的展现，降低带宽和流量开销
压缩方式
JS CSS 图片 HTML代码的压缩
Gzip 压缩
JS压缩：去空格回车
JS压缩工具:UglifyJs ，YUI Compressor 等
Gzip 压缩
nginx 配置
gzip on|off; #是否开启gzip
gzip_buffers 32 4K| 16 8K #缓存（在内存中缓冲几块？每快多大）
gzip_comp_level [1-9] #推荐6 压缩级别（级别越高，压的越小，越浪费CPU计算资源）
gzip_disable #正则匹配UA 什么样的Uri不进行gzip
gzip_min_length 200 #开始压缩的最小长度
gzip_http_version 1.0|1.1 #开始压缩的http协议版本
gzip_proxied   #设置请求者代理服务器，改如何缓存内容
gzip_types text/plain application/xml #对哪些类型的文件用压缩 如txt xml html css
gzip_vary on|off #是否传输gzip压缩标志
GRUNT
---------------------------------------
CDN
概念:Content Delivery Networl,内容分发网络
其基本思路是尽可能避开互联网上有可能影响数据传输速度和稳定性的瓶颈和环节，使内容传输的更快、更稳定。通过在网络各处放置节点服务器所构成的在现有的互联网基础之上的一层智能虚拟网络，CDN系统能够实时地根据网络流量和各节点的连接、负载状况以及到用户的距离和响应时间等综合信息将用户的请求重新导向离用户最近的服务节点上。
其目的是使用户可就近取得所需内容，解决Internet网络拥挤的状况，提高用户访问网站的响应速度。

优势
本地cache加速,提高网站（尤其多图的和静态页面）的访问速度
跨运营商的网络加速，保证不同网络的用户都得到良好的访问质量
远程访问用户根据DNS负载均衡技术智能自动选择cache服务器
自动生成服务器的远程mirror（镜像）cache服务器，远程用户范文时从cache服务器上读取数据，减少远程访问的带宽，分担网络流量，减轻站点WEB服务器负载等功能
广泛分布的CDN节点加上节点之间的智能冗余机制，可以有效地预防黑客入侵


原理
传统访问：浏览器输入地址-->域名解析获取服务器ip-->根据IP地址找到对应服务器-->服务器响应并返回数据
CDN访问:用户发起请求-->智能DNS解析(根据ip判断地理位置，接入网关类型，选择路由最短和负载最轻的服务器)-->取得缓存服务器ip-->把内容返回给用户(如果缓存中有)-->向源站发起请求--》结果返回给用户-->将结果存入缓存服务器


适用场景
站点或者应用中大量静态资源的加速分发，如css js 图片 html 大文件下载  直播 等

实现
BAT提供的CDN服务
可用LVS做4层负载均衡
可用naxin apache varnish squid trafficserver 做7层负载均衡和cache
使用squid反向代理，nginx反向代理
---------------------------------------
独立图片服务器
概念

独立的必要性
分担服务器I/O负载-将耗费资源的图片服务分离出来，提高服务器的性能和稳定性
可专门对图片服务进行优化，为图片服务设置针对性的缓存方案，减少带宽成本，提高访问速度
提交网站可扩展新，通过增加图片服务器，提高图片吞吐能力

采用独立域名
原因:同一域名浏览器的并发连接数有限制，突破浏览器连接数的限制
由于cookie,对缓存不利，大部分webcache都只缓存不带cookie请求，导致每次图片请求都不能命中cache

独立后的问题
同步：NFS共享方式，利用FTP同步

---------------------------------------
动态语言静态化
概念

什么是
将php等动态语言的逻辑代码生成静态html文件，用户访问动态脚本重定向到静态html文件的过程
对实时性要求不高的页面用(不经常改动的)

为什么
动态脚本通常会做逻辑计算和数据查询，访问量越大，服务器压力越大
访问量大时可能会造成CPU负载过高，数据库服务器压力过大
静态化可减轻逻辑处理压力，降低数据库服务器查询压力

实现
使用模板引擎
使用smarty的缓存机制生成静态HTML缓存文件
$smarty->cahe_dir = $ROOT."/cache";//缓存目录
$smarty->caching = true;//是否开启缓存
$smarty->cahe_lifetime = "3600";//缓存时间
$smarty->display(string template,string cahe_id,string complie_id);

ob系列函数
ob_start();//打开输出控制缓冲
ob_get_contents();//返回输出缓冲区内容
ob_clean();//清空输出层缓冲区
ob_end_flush();//送出输出缓冲区内容并关闭缓冲


使用

ob_start();

要输出的内容,html

ob_get_contents();
ob_end_flush();
fopen()（file_put_content）写入进html
判断是否缓存过期  filemtime
<?php
    $cache_name = md5(__FILE__).".html";
    $expire_time = 10;//过期时间
    //如果当前文件有改动或缓存到时间，就更新缓存
    if(filemtime(__FILE__) <= filemtime($cache_name) && file_exists($cache_name) && filemtime($cache_name) + $expire_time >= $_SERVER['REQUEST_TIME']){
        include $cache_name;
        exit;
    }
    ob_start();
    echo "<h1>当前时间是：".date('Y-m-d H:i:s')."</h1>";
    $contents = ob_get_contents();
    file_put_contents($cache_name,$contents);
    ob_end_flush();
?>
---------------------------------------
数据库缓存

概念
mysql（关系型数据库）数据存储在磁盘中，高并发场景下，业务应用对mysql增删改查操作造成巨大I/O开销和查询压力，对数据库和服务器都是一种巨大压力，为解决此类问题，缓存数据的概念应运而生

为什么
极大地解决数据库服务器压力
提高应用数据的响应速度

形式：内存缓存，文件缓存
场景：
实时性


使用查询缓存
启用：
query_cache_type (0:不使用，1：始终用，2:按需要使用)
query_cache_type 为 1时，不用：
SELECT SQL_NO_CACHE * FROM `table` WHERE condition;
query_cache_type 为 2时，按需用：
SELECT SQL_CACHE * FROM `table` WHERE condition;

quert_cache_size:默认内存为0，则为无法使用查询缓存
1。在ini改 query_cache_size=128M 
2。 SET GLOBAL quert_cache_size = 134217728;

第二次查询的SQL完全一样才会使用缓存
SHOW STATIC LIKE `Qcache_hits`;查看命中次数
表结构，数据 改变时，查询缓存的数据不再有效

清理
FLUSH QUERY CACHE;//清理查询换内存碎片
RESET QUERY CACHE;//移出所有查询缓存
FLUSH TABLES;//关闭所有打开的表，同时清空所有查询缓存的内容

memcache

redis

其他
session
session_set_value_handler
---------------------------------------
---------------------------------------
---------------------------------------
---------------------------------------