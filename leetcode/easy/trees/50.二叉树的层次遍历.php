<?php

//
// class TreeNode {
//      public $val = null;
//      public $left = null;
//      public $right = null;
//      function __construct($value) { $this->val = $value; }
//  }
require_once "../../../learn/data/tree.php";
class Solution {


    function levelOrder($root) {
        if($root == NULL){
            return [];
        }
        $root->index = 0;
        $queue = [$root];
        $res = [];

        while(!empty($queue)){
            $current = array_pop($queue);
            $i = $current->index;
            $res[$i][] = $current->val;
            if($current->left != NULL){
                $current->left->index = $i + 1;
                array_unshift($queue,$current->left);
            }
            if($current->right != NULL){
                $current->right->index = $i + 1;
                array_unshift($queue,$current->right);
            }
        }
        return $res;
    }
}




$arr = [5,1,4,null,null,3,6];


$root = (new BinaryTree())->create($arr);


$res = (new Solution())->levelOrder($root);

var_dump($res);

