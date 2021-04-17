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
    function mergeTrees($t1, $t2) {
        if($t1 === NULL){
            return $t2;
        }
        if($t2 === NULL){
            return $t1;
        }

        $t1->val += $t2->val;

        $t1->left = $this->mergeTrees($t1->left,$t2->left);
        $t1->right = $this->mergeTrees($t1->right,$t2->right);
        return $t1;
    }
}