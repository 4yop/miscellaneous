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


    function isValidBST($root) {
        return $this->helper($root,NULL,NULL);
    }

     function helper($node, $lower, $upper) {
        if ($node == null) return true;

        $val = $node->val;
        if ($lower != null && $val <= $lower) return false;
        if ($upper != null && $val >= $upper) return false;

        if (! $this->helper($node->right, $val, $upper)) return false;
        if (! $this->helper($node->left, $lower, $val)) return false;
        return true;
      }
}




$arr = [5,1,4,null,null,3,6];


$root = (new BinaryTree())->create($arr);


$res = (new Solution())->isValidBST($root);

var_dump($res);

