<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/21
 * Time: 11:12
 */

    /**
     * 桶排序
     */
    declare (strict_types = 1);
    $a = [];
    $m = 1000;
    //执行了m次
    for($i= 0;$i <= $m;$i++){
        $a[$i] = 0;
    }
    fwrite(STDOUT,'几个数:');
    $n = intval(fgets(STDIN));
    //执行n次
    for ($i = 0;$i< $n;$i++){//n个桶
        fwrite(STDOUT,'input vale:');

        $t = intval(fgets(STDIN));
        $a[$t]++;
    }
    //执行了m+n次
    for($i=0;$i<=$m;$i++){//0-10号桶 有多少个就输出多少次桶号

        for($j=0;$j<$a[$i];$j++){
            echo "$i\t";

        }

    }

    //时间复杂度 m+n+m+n 即 O(2*(m+n))



    return 0;