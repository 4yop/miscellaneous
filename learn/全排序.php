<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/6
 * Time: 15:11
 */
    class Solution {
        public $n = 3;
        public $book = [];
        public $res = [];
        public $a = [];
        public function allorder($step = 1){

            if($step == $this->n + 1){
                $this->res[] = implode('',$this->a);
            }

            for($i = 1;$i<=$this->n;$i++){
                if($this->book[$i] == 0){
                    $this->a[$step] = $i;
                    $this->book[$i] = 1;
                    $this->allorder($step+1);
                    $this->a[$i] = 0;
                }
            }
            return $this->res;
        }
    }

    $s = new Solution();

    $res = $s->allorder();

    print_r($res);