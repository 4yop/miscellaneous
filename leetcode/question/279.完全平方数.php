<?php






class Solution {

    /**
     * @param Integer $n
     * @return Integer
     */
    function numSquares($n) {
       
        if(sqrt($n) == intval(sqrt($n))){
            return 1;
        }
        //找出比$n 小的平方数
        $nums = [];
        for($i = 1;$i * $i < $n;$i++){
            $nums[] = $i * $i;
        }
        $res = PHP_INT_MAX;
        $queue = [['num'=>$n,'count'=>0]];
        while(!empty($queue)){
            $curr = array_shift($queue);

            foreach ($nums as $v){

                if($curr['num'] - $v  == 0 ){
                    if($curr['count']+1 < $res){
                        $res = $curr['count']+1;
                    }
                    continue;
                }
                if($curr['num'] - $v < 0){
                    continue;
                }
                if($curr['count']+1 >= $res){
                    continue;
                }
                $q = [
                    'num' => $curr['num'] - $v,
                    'count' => $curr['count']+1,
                ];
                array_push($queue,$q);
            }//end foreach
        }//end while
        return $res;
    }
}

$so = new Solution();

//1211
$res = $so->numSquares(7168);
print_r($res);