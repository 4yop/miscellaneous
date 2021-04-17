<?php

//
// class TreeNode {
//      public $val = null;
//      public $left = null;
//      public $right = null;
//      function __construct($value) { $this->val = $value; }
//  }
require_once "../../learn/data/tree.php";
class Solution {

    //迭代遍历
    function zigzagLevelOrder($root) {
        if($root === NULL){
            return [];
        }

        $root->index = 0;
        $queue = [$root];
        $res = [];//结果

        while(!empty($queue)){
            $curr = array_shift($queue);
            $index = $curr->index;
            if(!array_key_exists($index,$res)){
                $res[$index] = [];
            }
            if($index % 2 == 0){
                $res[$index][] = $curr->val;
            }else{
                array_unshift($res[$index],$curr->val);
            }
            if($curr->left !== NULL){
                $curr->left->index = $index+1;
                array_push($queue,$curr->left);
            }
            if($curr->right !== NULL){
                $curr->right->index = $index+1;
                array_push($queue,$curr->right);
            }
        }
        return $res;
    }

    //递归遍历
    public $res = [];
    function zigzagLevelOrder1($root){
        $this->helper($root);
        return $this->res;
    }

    function helper($root,$index = 0){
        if($root === NULL){
            return;
        }


        if($index % 2 == 0){
            $this->res[$index][] = $root->val;
        }else{
            if(!array_key_exists($index,$this->res)){
                $this->res[$index] = [];
            }
            array_unshift($this->res[$index],$root->val);
        }
        $this->helper($root->left,$index+1);
        $this->helper($root->right,$index+1);
    }
}




$arr = [1,2,3,4,5,6,7];

//   1
// 2  3
//4 5 6 7
//输出
// 1, 3 2, 4 5 6 7,

$root = (new BinaryTree())->create($arr);

$res = (new Solution())->zigzagLevelOrder1($root);

var_dump($res);

