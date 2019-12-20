<?php
    /**
     * 栈
     */


    fwrite(STDOUT,'输入字符串:');
    $a = trim(fgets(STDIN));
    $len = strlen($a);

    $mid = $len/2 - 1;
    $top = 0;
    for($i = 0;$i < $mid;$i++){

        $s[++$top] = $a[$i];

    }

    if($mid % 2 == 0){
        $next = $mid + 1;
    }else{
        $next = $mid + 2;
    }

    for($i = $next;$i < $len;$i++){

        if($a[$i] != $s[$top]){
//            echo "a[$i]($a[$i])!=s[$top]($s[$top])";
//            echo "NO";

            break;
        }

        $top--;
    }

    echo "YES";







