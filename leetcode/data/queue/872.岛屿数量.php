<?php


class Solution {


    function numIslands($grid) {
        $count = 0;
        $row = count($grid);
        $col = count($grid[0]);
        for ($i = 0;$i<$row;$i++){
            for($j = 0;$j<$col;$j++){
                if($grid[$i][$j] == 1) {
                    $grid = $this->change($grid,[$i,$j]);
                    $count++;
                }
            }
        }
        return $count;
    }

    /**将当前岛屿的1全变成x，表明已经数过这个岛了
     * @param $arr
     * @param $position 岛的开头坐标
     * @return mixed
     */
    function change($arr,$position){
        $queue = [];
        array_unshift($queue,$position);
        while(!empty($queue)){
            list($x,$y) = array_pop($queue);
            if($arr[$x][$y] == 1){
                $arr[$x][$y] = 'x';
                if($arr[$x+1][$y] == 1){
                    array_unshift($queue,[$x+1,$y]);
                }
                if($arr[$x][$y+1] == 1){
                    array_unshift($queue,[$x,$y+1]);
                }
                if($x-1 >= 0 && $arr[$x-1][$y] == 1){
                    array_unshift($queue,[$x-1,$y]);
                }
                if($y-1 >= 0 && $arr[$x][$y-1] == 1){
                    array_unshift($queue,[$x,$y-1]);
                }
            }
        }
        return $arr;
    }

}



$grid =[
    [1,0,1,0,0,1,0,0],
    [1,0,1,0,0,1,0,0],
    [1,0,1,0,0,1,0,0],
];


$res = (new Solution())->numIslands($grid);
var_dump($res);