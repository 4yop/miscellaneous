<?php






class Solution {


    function uniquePaths($m, $n) {
        //高为 n ，宽为m
//        $x = 1;
//        $y = 1;
        //[3,2]
        $queue = [
           [1,1],
        ];
        $i = 0;
        while($i < count($queue)){
            list($x,$y) = $queue[$i];
            if($x == $m && $y == $n){
                $i++;
                continue;
            }
            $flag = true;
            if($x < $m){
                $flag = false;

                $queue[] = [$x+1,$y];
            }
            if($y < $n){
                $queue[] = [$x+1,$y];
            }
        }

        return $queue;
    }
}

$so = new Solution();
$res = $so->uniquePaths(7,3);
print_r($res);