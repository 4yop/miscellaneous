<?php

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
require_once "../../learn/data/tree.php";
class Solution {


    function deepestLeavesSum($root) {
        
    }




}

$arr = [1,2,3,4,5,null,6,7,null,null,null,null,8];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->deepestLeavesSum($root);

print_r($res);