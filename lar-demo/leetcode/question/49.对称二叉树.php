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


    function isSymmetric($root) {
        return $this->digui($root->left,$root->right);
    }

    function digui($one,$two){
        if($one === NULL && $two === NULL){
            return true;
        }
        if($one->val !== $two->val){
            return false;
        }

        if(!$this->digui($one->left,$two->right)){
            return false;
        }



        if(!$this->digui($one->right,$two->left)){
            return false;
        }

        return true;
    }
}




$arr = [1,2,2,3,4,4,3];


$root = (new BinaryTree())->create($arr);


$res = (new Solution())->isSymmetric($root);

var_dump($res);

