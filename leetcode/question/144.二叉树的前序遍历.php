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

    //递归
    public $res = [];
    function preorderTraversal1($root) {
        if ($root !== null) {
            $this->helper($root);
        }
        return $this->res;
    }

    function helper($root) {
        $this->res[] = $root->val;
        if ($root->left !== null) {
            $this->helper($root->left);
        }
        if ($root->right !== null) {
            $this->helper($root->right);
        }
    }

    //迭代
    function preorderTraversal($root) {
        if ($root === null) {
            return [];
        }
        $stack = [$root];
        $res = [];
        while (!empty($stack)) {
            $curr = array_shift($stack);
            array_push($res,$curr->val);

            if ($curr->right !== null) {
                array_unshift($stack,$curr->right);
            }
            if ($curr->left !== null) {
                array_unshift($stack,$curr->left);
            }
        }
        return $res;
    }
}




$arr = [3,9,20,null,null,15,7];


$root = (new BinaryTree())->create($arr);


$res = (new Solution())->preorderTraversal($root);

echo $res;

