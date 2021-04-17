<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2019/11/30
 * Time: 14:35
 */
class Solution {

    function subsets1($nums) {
        sort($nums);
        $queue = [[]];
        $i = 0;
        while($i < count($queue)){
            foreach ($nums as $v){
                if(in_array($v,$queue[$i]) || max($queue[$i]) > $v ){
                    continue;
                }
                $temp = $queue[$i];
                $temp[] = $v;
                $queue[] = $temp;

            }
            if(count($temp) == count($nums)){
                break;
            }
            $i++;
        }
        return $queue;
    }


    protected $result;
    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function subsets($nums)
    {
        // 画出递归树，答案是遍历递归树的所有节点
        $this->result[] = [];
        $this->sub($nums, [], 0);
        return $this->result;
    }

    private function sub($nums, $list, $start)
    {
        if (count($list) == count($nums)) {
            return;
        }
        for ($i = $start; $i < count($nums); ++$i) {
            $list[] = $nums[$i];
            // 在这里，递归中途添加，而不是递归终止条件处添加
            $this->result[] = $list;
            $this->sub($nums, $list, $i + 1);
            array_pop($list);
        }
    }




}









$solution = new Solution1();
$res = $solution->subsets([1,2,3]);
print_r($res);