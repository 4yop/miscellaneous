<?php






class Solution {


    function allCellsDistOrder($R, $C, $r0, $c0) {
        $posit = [];
        $dist = [];

        for($i = 0;$i < $R;$i++){
            for($j = 0;$j < $C;$j++){
                $posit[] = [$i,$j];
                $dist[] = abs($r0-$i)+abs($c0-$j);

            }
        }
        asort($dist);

        $keys = array_keys($dist);

        $res = [];
        foreach ($posit as $k=>$v){
            $key = $keys[$k];
            $res[$k] = $posit[$key];
        }
        return $res;
    }


}

$so = new Solution();
$R = 1; $C = 2; $r0 = 0;  $c0 = 0;
$res = $so->allCellsDistOrder($R, $C, $r0, $c0);
print_r($res);