<?phP

/**
 * 异步redis
 */

 $redis = new swoole_redis();
 $host = '127.0.0.1';
 $port = 6379;
 $redis->connect($host,$port,function($redis,$res){

 });