<?php






class Solution {


    function setZeroes($matrix) {

        $queue = [];

        for($i = 0;$i < count($matrix);$i++){

            for($j = 0;$j < count($matrix[$i]);$j++){
                if($matrix[$i][$j] == 0){
                    $queue[] = [$i,$j];
                }
            }

        }

        foreach ($queue as $v){
            list($x,$y) = $v;

            for ($i = 0;$i < count($matrix[$x]);$i++){
                $matrix[$x][$i] = 0;
            }

            for ($j = 0;$i < count($matrix);$j++){
                $matrix[$j][$x] = 0;
            }
        }
        return $matrix;
    }
}

$so = new Solution();
$nums = [
    [0,1,2,0],
    [3,4,5,2],
    [1,3,1,5]
];
$val = 3;
$res = $so->setZeroes($nums);
print_r($res);