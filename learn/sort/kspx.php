<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/21
 * Time: 14:42
 */
/**
 * 快速排序
 */


class test{

    public $arr = [];

    public function quicklySort($left,$right){

        if($left > $right){
            return '';
        }
        $temp = $this->arr[$left];
        $i = $left;
        $j = $right;
        while($i != $j){

            while($this->arr[$j] >= $temp && $i < $j){
                $j--;
            }
            while($this->arr[$i] <= $temp && $i < $j){
                $i++;
            }

            if($i < $j){
                $t = $this->arr[$i];
                $this->arr[$i] = $this->arr[$j];
                $this->arr[$j] = $t;
            }
        }

        $this->arr[$left] = $this->arr[$i];
        $this->arr[$i]    = $temp;
        $this->quicklySort($left,$i-1,$this->arr);
        $this->quicklySort($i+1,$right,$this->arr);
    }

    public function main(){
        fwrite(STDOUT,"how values:");
        $n = intval(fgets(STDIN));

        for($i = 0;$i < $n;$i++){
            fwrite(STDOUT,"input arr[{$i}] value:");
            $val = fgets(STDIN);
            $this->arr[$i] = $val;
        }
        $this->quicklySort(0,$n-1);
        print_r($this->arr);
    }
}

$class = new Test();
$class->main();