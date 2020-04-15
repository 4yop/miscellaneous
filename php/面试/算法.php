<?php
    //冒泡排序

    //算法的概念，时间复杂度 空间复杂度
    //排序算法 查找算法

    //O(n) 执行了n次
    $arr = [1,2,'...','n'];
    $sum = 0;
    for($i = 1;$i<=$n;$i++){
        $sum += $i;
    }
    //O(1)  n无论为多少都执行m(常数)次


    //O(n^2)
    for($i = 1;$i<=$n;$i++){
        for($j = 1;$j<=$n;$j++){

        }
    }

    /**
     * 排序
     * 冒泡排序
     * 直接插入排序
     * 希尔排序
     * 选择排序
     * 快速排序
     * 堆排序
     * 归并排序
     */
    //冒泡排序
    $arr = [1,4,3,5,7,6,2];
    // 第一层for循环可以理解为从数组中键为0开始循环到最后一个
    for ($i=0;$i<count($arr)-1;$i++) {
        // 第二层将从键为$i的地方循环到数组最后
        for ($j=$i+1;$j<count($arr);$j++) {
            // 比较数组中相邻两个值的大小
            if ($arr[$i] > $arr[$j]) {
                $tmp     = $arr[$i]; // 这里的tmp是临时变量
                $arr[$i] = $arr[$j]; // 第一次更换位置
                $arr[$j] = $tmp;            // 完成位置互换
            }
        }
    }
       // print_r($arr);

//数据结构
/**
 * stack
 * heap
 * list
 * doubly-linked-list
 * queue
 * array
 **/

$str = "make_by_id";

$res = implode('',array_map("ucfirst",explode('_',$str)));
//echo $res;


