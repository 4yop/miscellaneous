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

        foreach($queue as $v){
            list($a,$b) = $v;

            for ($i = 0;$i < count($matrix[$a]);$i++){
                $matrix[$a][$i] = 0;
            }

            for ($i = 0;$i < count($matrix);$i++){
                $matrix[$i][$b] = 0;
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