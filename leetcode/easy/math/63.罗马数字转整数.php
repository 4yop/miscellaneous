<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function romanToInt($s) {
    	$note = [
            'I' => 1,
            'V' => 5,
            'X' => 10,
            'L' => 50,
            'C' => 100,
            'D' => 500,
            'M' => 1000,
        ];
        //存在就直接返回
        if(array_key_exists($s, $note)){
            return $note[$s];
        }else{
            $len = strlen($s);
            $nums = [];
            //获取字符对应值
            for($i = 0;$i<$len;$i++){
                $nums[] = $note[$s[$i]];
            }
            $sum = $nums[0];
            for($i = 1;$i<$len;$i++){
                
                if($nums[$i-1]  >= $nums[$i]){
                   
                    $sum+=$nums[$i];
                }else{
                    
                    $sum+=($nums[$i]-2*$nums[$i-1]);
                }
            }

            return $sum;
        }

    }

    

}

$s = new Solution();

$res = $s->romanToInt('MCMXCIV');
print_r($res);







