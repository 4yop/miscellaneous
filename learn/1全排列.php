123

1和2换 132
拿原素组

0和1换 213
1和2换 231
拿原数组

0和2换 321
1和2换 312


<?php

    $arr = [1,2,3];

    class s{
        public $res = [];

        function pp($arr){
            $this->p($arr,0,count($arr)-1);
            return $this->res;
        }

        function p($arr,$start=0,$end=0){
            if($start == $end){
                $this->res[] = $arr;
            }

            for($i = $start;$i<=$end;$i++){

                $temp = $arr[$i];
                $arr[$i] = $arr[$start];
                $arr[$start] = $temp;

                $this->p($arr,$start+1,$end);

                $temp = $arr[$i];
                $arr[$i] = $arr[$start];
                $arr[$start] = $temp;
            }
        }



    }

    $s = new s();
    $r = $s->pp([1,2,3]);
    print_r($r);
    exit;
?>


<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function permute($nums) {
        $this->perm($nums,0,count($nums)-1);

        return $this->result;
    }


    function swap(&$arr,$p,$q){
        $temp=$arr[$p];
        $arr[$p]=$arr[$q];
        $arr[$q]=$temp;
    }
    function perm($arr,$p,$q){
        if($p==$q){
            $this->result[]=$arr;
            return;
        }
        for($i=$p;$i<=$q;$i++){
            $this->swap($arr,$p,$i);//交换 ，第一回，数组0号元素当首位；第二回p=1，第一号元素当首位
            $this->perm($arr,$p+1,$q);//后面的1号元素 到 n-1个元素，继续排列组合；后面的2号元素 到最后一个元素，继续排列组合
            $this->swap($arr,$p,$i);//复原数组
        }
    }

}

$s = new Solution();
$r = $s->permute([1,2,3]);
print_r($r);