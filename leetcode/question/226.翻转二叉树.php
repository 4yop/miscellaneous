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
class Solution {

    /**
     * @param TreeNode $root
     * @return TreeNode
     */
    function invertTree($root) {
        $this->swap($root);
        return $root;
    }

    function swap($root){
        if($root->left === NULL && $root->right === NULL){
            return;
        }

        $temp = $root->left;
        $root->left = $root->right;
        $root->right = $temp;
        if($root->left !== NULL){
            $this->swap($root->left);
        }

        if($root->right !== NULL){
            $this->swap($root->right);
        }

    }
}