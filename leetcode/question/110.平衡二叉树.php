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

    /**每个节点的高度差不超过一就是平衡二叉树
     * @param $root
     */
    function isBalanced($root) {
        if($root === NULL){
            return true;
        }
        return
            abs($this->height($root->left) - $this->height($root->right) ) < 2
            && $this->isBalanced($root->left)
            && $this->isBalanced($root->right);
    }

    function height(TreeNode $root){
        if($root === NULL){
            return -1;
        }
        return 1 + max($this->height($root->left),$this->height($root->right));
    }

}


$arr = [1,null,2,null,3];

$tree = new BinaryTree();
$root = $tree->create($arr);
var_dump($root);
$res = (new Solution())->isBalanced($root);

var_dump($res);