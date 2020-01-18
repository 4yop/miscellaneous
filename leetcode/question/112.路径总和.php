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

    /**
     * @param TreeNode $root
     * @return Integer[][]
     */
    function hasPathSum($root, $sum) {
        if($root === NULL){
            return false;
        }
        $sum -= $root->val;
        if($root->left === NULL && $root->right === NULL){
            return $sum === 0;
        }
        return $this->hasPathSum($root->left,$sum) || $this->hasPathSum($root->right,$sum);
    }


}

$arr = [-2,null,-3];

$tree = new BinaryTree();
$root = $tree->create($arr);

$res = (new Solution())->hasPathSum($root,5);

var_dump($res);