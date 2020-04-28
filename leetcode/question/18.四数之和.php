<?php






class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[][]
     */
    function fourSum($nums, $target) {
        $len = count($nums);
        if($len == 4){
            return array_sum($nums) == $target ? [$nums] : [];
        }
        $len1 = $len - 1;
        $len2 = $len - 2;
        $len3 = $len - 3;
        sort($nums);
        $res = [];

        for($i = 0;$i < $len3;$i++){

            for($j = $i + 1;$j < $len2;$j++){

                $k = $j + 1;
                $l = $len1;

                while ($k < $l){
                    $sum = $nums[$i] + $nums[$j] + $nums[$k] + $nums[$l];
                    if($sum == $target){
                        $res[] = [ $nums[$i] , $nums[$j] , $nums[$k] , $nums[$l] ];
                        $k++;
                        while ($k < $l && $nums[$k] == $nums[$k-1]){
                            $k++;
                        }
                        $l--;
                        while ($k < $l && $nums[$l] == $nums[$l+1]){
                            $l--;
                        }
                    }elseif ($sum < $target){

                        $k++;
                        while ($k < $l && $nums[$k] == $nums[$k-1]){
                            $k++;
                        }
                    }else{
                        $l--;
                        while ($k < $l && $nums[$l] == $nums[$l+1]){
                            $l--;
                        }

                    }//end if sum = > <


                }//end while $k < $l

            }//end for j

        }//end for i
        return array_unique($res,SORT_REGULAR);
    }
}

$so = new Solution();

$res = $so->fourSum([
    [-1,  0, 0, 1],
    [-2, -1, 1, 2],
    [-2,  0, 0, 2]
]);
var_dump($res);