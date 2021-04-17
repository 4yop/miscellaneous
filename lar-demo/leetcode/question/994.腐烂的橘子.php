<?php






class Solution {

    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function orangesRotting($grid) {

        $num = 0;
        $bad = [];
        foreach($grid as $k=>$v){
            foreach($v as $kk=>$vv){
                if($vv === 1){
                    $num++;
                }
                if($vv === 2){
                    $bad[] = [$k,$kk];
                }
            }
        }

        if(empty($bad)){
            return -12;
        }
        if($num === 0){
            return 0;
        }
        $minute = 1;
        while(!empty($bad) && $num > 0){
        $has = false;
        list($i,$j) = array_shift($bad);
        //左边
        if($grid[$i-1][$j] && $grid[$i-1][$j] === 1){
            $has = true;
            array_push($bad,[$i-1,$j]);
            $num--;
            $grid[$i-1][$j] = 2;
        }
        //右边
        if($grid[$i+1][$j] && $grid[$i+1][$j] === 1){
            $has = true;
            array_push($bad,[$i+1,$j]);
            $num--;
            $grid[$i+1][$j] = 2;
        }
        //上
        if($grid[$i][$j-1] && $grid[$i][$j-1] === 1){
            $has = true;
            array_push($bad,[$i,$j-1]);
            $num--;
            $grid[$i][$j-1] = 2;
        }
        //下
        if($grid[$i][$j+1] && $grid[$i][$j+1] === 1){
            $has = true;
            array_push($bad,[$i,$j+1]);
            $num--;
            $grid[$i][$j+1] = 2;
        }
        if($has === false){
            break;
        }
        $minute++;
    }
        return $num == 0 ? $minute :":$num";
    }


}


$so = new Solution();
$nums = "dvdf";
$val = 3;
$res = $so->orangesRotting(
    [[2,1,1],[1,1,0],[0,1,1]]);
print_r($res);