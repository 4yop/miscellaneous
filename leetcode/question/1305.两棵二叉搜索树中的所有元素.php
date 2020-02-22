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
     * @param TreeNode $root1
     * @param TreeNode $root2
     * @return Integer[]
     */
    public $res = [];
    function getAllElements($root1, $root2) {
        $this->helper($root1);
        $this->helper($root2);
        sort($this->res);
        return $this->res;
    }

    function helper(TreeNode $root = NULL){
        if($root === NULL){
            return;
        }
        $this->res[] = $root->val;
        $this->helper($root->left);
        $this->helper($root->right);
    }
}
