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
        $stack = [];
        $depth = 0;

        array_unshift($stack,$root);
        $current_depth = 0;
        while(!empty($stack)){

            $root = array_pop($stack);
            if($root !== NULL){
                $depth = max($current_depth,$depth);
                array_push($stack,[$current_depth+1,$root->left]);
                array_push($stack,[$current_depth+1,$root->right]);
            }
        }
        return $depth;
    }
}




$arr = [3,9,20,null,null,15,7];


$root = (new BinaryTree())->create($arr);


$res = (new Solution())->maxDepth($root);

echo $res;

