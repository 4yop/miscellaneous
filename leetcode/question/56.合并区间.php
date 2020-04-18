<?php
//55. 跳跃游戏





class Solution {


    function merge($intervals) {
        array_multisort($intervals, SORT_ASC, array_column($intervals,0),SORT_ASC,array_column($intervals,1));
        $res = [$intervals[0]];
        $j = 0;
        $i = 1;
        while($i < count($intervals)){
            list($start1,$end1) = $intervals[$i];
            list($start2,$end2) = $res[$j];
            if( ($start1 <= $start2 && $start2 <= $end1) || ($start2 <= $start1 && $start1 <= $end2) ){
                $res[$j] = [min($start1,$start2),max($end1,$end2)];
            }else{
                $j++;
                $res[$j] = $intervals[$i];
            }
            $i++;
        }
        return $res;
    }
}

$so = new Solution();
$nums =  [[1,3],[2,6],[1,2],[8,10],[15,18]];
$res = $so->merge($nums);
print_r($res);