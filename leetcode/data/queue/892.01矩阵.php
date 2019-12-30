<?php



class Solution {

    /**
     * @param Integer[][] $matrix
     * @return Integer[][]
     */
    function updateMatrix($matrix) {

        $res = [];

        $row = count($matrix);
        $col = count($matrix[0]);

        for($i = 0;$i < $row;$i++){

            for($j = 0;$j < $col;$j++){

                if($matrix[$i][$j] == 0){
                    $res[$i][$j] = 0;
                }else{
                    $res[$i][$j] = $this->BFS($matrix,[$i,$j]);
                }
            }
        }
        return $res;
    }

    function BFS($matrix,$position){

        $queue = [$position];
        $row = count($matrix);
        $col = count($matrix[0]);
        $end = [];
        while(!empty($queue)){

            list($x,$y) = array_pop($queue);
            //上
            if($x - 1 >= 0){
                if($matrix[$x-1][$y] == 0){
                    $end =  [$x-1,$y];
                    break;
                }else{
                    array_unshift($queue,[$x-1,$y]);
                }
            }
            //下
            if($x + 1 <= $row){
                if($matrix[$x + 1][$y] == 0){
                    $end =   [$x + 1,$y];
                    break;
                }else{
                    array_unshift($queue,[$x + 1,$y]);
                }
            }
            //左
            if($y - 1 >= 0){
                if($matrix[$x][$y - 1] == 0){
                    $end =    [$x,$y - 1];
                    break;
                }else{
                    array_unshift($queue,[$x,$y - 1]);
                }
            }
            //右
            if($y + 1 <= $col){
                if($matrix[$x][$y + 1] == 0){
                    $end =    [$x,$y + 1];
                    break;
                }else{
                    array_unshift($queue,[$x,$y + 1]);
                }
            }

        }
        list($i,$j) = $position;
        list($x,$y) = $end;
        return "abs($i-$x)+abs($j-$y)";
    }
}

$matrix = [
    [0,0,0],
    [0,1,0],
    [1,1,1]
];

$res = (new Solution())->updateMatrix($matrix);
print_r($res);





