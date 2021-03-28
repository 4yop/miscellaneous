<?php
    //双链表
    $list = new SplDoublyLinkedList();
    $list->push('a');//末尾插入元素



    $list->add(1,'add index 1');//在 index为 1的前面插入,其余的index 后移，如果 $list 为空 只能插入0的位置

    $bottom = $list->bottom();//获取第一个节点的值
    $top = $list->top();//获取最后一个节点值



    $count = $list->count();//获取 链表节点个数


    $mode = $list->getIteratorMode();//返回迭代模式
    $isEmpty = $list->isEmpty();//是否为空

    $shift = $list->shift();//移除第一个节点并返回值
    $list->unshift('a');//前面插入值


    $offsetExists = $list->offsetExists(999);//索引是否存在
//    $offsetGet = $list->offsetGet(4);
//    $list->offsetSet(4,'off set index:4');
//    $offsetSet = $list->offsetGet(4);


    //$list->offsetUnset(4);//删除 索引为 4的节点
    $pop = $list->pop();

//    $serialize = $list->serialize();//序列化
//    $aa = $list->unserialize($serialize);
//    print_r($aa);exit;


    //指针
    $next = $list->next();//移动到下个节点
    $prev = $list->prev();//移动到上个节点
    $list->rewind();//重置指针
    $key = $list->key();//当前节点的 索引
    $current = $list->current();//获取单钱节点




    //var_dump(compact('list','bottom','count','current','mode','isEmpty','key','prev','next','offsetExists','offsetGet','offsetSet','pop','top','shift'));
    //print_r($list);


