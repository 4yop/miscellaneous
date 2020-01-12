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


    function preorderTraversal($root) {

    }
}




$arr = [3,9,20,null,null,15,7];


$root = (new BinaryTree())->create($arr);


$res = (new Solution())->preorderTraversal($root);

echo $res;

