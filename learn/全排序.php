<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/12/6
 * Time: 15:11
 */
    class Solution {
        function allorder($nums){
            $this->qpl($nums,[]);
            return $this->res;
        }

        function qpl($nums,$arr){
            if(count($nums) == count($arr)){
                $this->res[] = $arr;
                return;
            }

            foreach ($nums as $v){
                if(!in_array($v,$arr)){
                    $arr[] = $v;

                    $this->qpl($nums,$arr);

                    array_pop($arr);
                }
            }

        }
    }

    $s = new Solution();

    $res = $s->allorder([1,2,3]);

    print_r($res);