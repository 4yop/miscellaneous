<?php






class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function numberOfSubarrays($nums, $k) {
        $res = 0;
        $count = count($nums);
        foreach($nums as $key => $v){
            $ji = 0;
            $n = 0;
            $i = $key;
            while($i < $count){
                if($nums[$i]%2 == 1){
                    $n++;
                }
                if($n == $k){
                    $res++;
                    break;
                }
                $i++;
            }

        }
        return $res;
    }
}

$so = new Solution();

$res = $so->numberOfSubarrays([2,2,2,1,2,2,1,2,2,2],2);
print_r($res);