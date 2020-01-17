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


    function maxDepth($root) {
        if($root == NULL){
            return 0;
        }
        $root->depth = 1;
        $queue = [$root];
        $depth = 0;
        while(!empty($queue)){
            $current = array_pop($queue);
            $currentDepth = $current->depth;//当前深度
            if($depth < $currentDepth){
                $depth = $currentDepth;
            }
            if($current->left !== NULL){
                $current->left->depth = $currentDepth+1;
                array_unshift($queue,$current->left);
            }
            if($current->right !== NULL){
                $current->right->depth = $currentDepth+1;
                array_unshift($queue,$current->right);
            }

        }
        return $depth;
    }
}




$arr = [3,9,20,null,null,15,7];


$root = (new BinaryTree())->create($arr);


$res = (new Solution())->maxDepth($root);

echo $res;

