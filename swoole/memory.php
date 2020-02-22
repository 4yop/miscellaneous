<?php
/**
 * 内存操作
 */
use Swoole\Table;
$table = new Table(1024);

$table->column('id',Table::TYPE_INT);

$table->column('username',Table::TYPE_STRING,20);

$table->column('create_time',Table::TYPE_INT);

$table->column('count',Table::TYPE_INT);

//创建表
$table->create();

//插入值
$res = $table->set('test1',[
    'id'=>1,
    'username'=>'lzh',
    'create_time'=>$_SERVER['REQUEST_TIME'],
    'count' => 0
]);
print_r(['插入'=>$res]);

//根据key值获取
$arr = $table->get('test1');
print_r($arr);

//test1数组里的count 的值自增
$count = $table->incr('test','count');
print_r(['自增'=>$count]);
//test1数组里的count 的值自减
$count = $table->decr('test','count');
print_r(['自减'=>$count]);

$key2 = 'test2';
$res = $table->exist($key2);
print_r([
    "有{$key2}?" => $res ? '有' : '无',
]);

print_r([
    "数量" => $table->count(),
]);



//删除$table->del('test1');
print_r($table);