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
     * @param TreeNode $t1
     * @param TreeNode $t2
     * @return TreeNode
     */
    function isUnivalTree($root) {
        if($root === null){
            return true;
        }
        if($root->left !== null && $root->left->val !== $root->val){
            return false;
        }
        if($root->right !== null  && $root->right->val !== $root->val){
            return false;
        }
        return $this->isUnivalTree($root->left) && $this->isUnivalTree($root->right) ;
    }
}